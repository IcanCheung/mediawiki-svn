package de.brightbyte.wikiword.schema;

import java.sql.Connection;
import java.sql.SQLException;
import java.util.regex.Pattern;

import javax.sql.DataSource;

import de.brightbyte.db.DatabaseField;
import de.brightbyte.db.EntityTable;
import de.brightbyte.db.KeyType;
import de.brightbyte.util.StringUtils;
import de.brightbyte.wikiword.DatasetIdentifier;
import de.brightbyte.wikiword.TweakSet;
import de.brightbyte.wikiword.model.WikiWordConcept;
import static de.brightbyte.wikiword.model.WikiWordConcept.*;

public class ConceptInfoStoreSchema extends WikiWordStoreSchema {
	public final String referenceSeparator; //info record separator
	public final String referenceFieldSeparator; //info field separator
	public final String languagePrefixSeparator; //language prefix separator
	
	public final Pattern conceptSeparatorPattern; //info record separator
	public final Pattern conceptFieldSeparatorPattern; //info field separator
	public final Pattern languagePrefixPattern; //language prefix separator

	public class ConceptListEntrySpec extends WikiWordConcept.ListFormatSpec {

		public final String joinField;
		public final String valueExpression;

		public ConceptListEntrySpec(String field, String expression, int flags) {
			super(conceptSeparatorPattern, conceptFieldSeparatorPattern, languagePrefixPattern, flags);
			
			this.joinField = field;
			this.valueExpression = expression;
		}
		
	}
	
	public final ConceptListEntrySpec langlinkReferenceListEntry;

	public final ConceptListEntrySpec termReferenceListEntry;
	public final ConceptListEntrySpec broaderReferenceListEntry;
	public final ConceptListEntrySpec narrowerReferenceListEntry;
	public final ConceptListEntrySpec inLinksReferenceListEntry;
	public final ConceptListEntrySpec outLinksReferenceListEntry;
	public final ConceptListEntrySpec similarReferenceListEntry;
	public final ConceptListEntrySpec relatedReferenceListEntry;
	public final ConceptListEntrySpec related2ReferenceListEntry;
	public final ConceptListEntrySpec featureReferenceListEntry;
	public final ConceptListEntrySpec proximityReferenceListEntry;
	
	protected EntityTable conceptInfoTable;
	protected EntityTable conceptDescriptionTable;
	
	private String fields(String... f) {
		if (f.length==0) return null;
		if (f.length==1) return f[0];
		
		String s = StringUtils.join(", '"+referenceFieldSeparator+"', ", f);
		return "concat("+s+")";
	}

	public ConceptInfoStoreSchema(DatasetIdentifier dataset, Connection connection, boolean description, TweakSet tweaks, boolean useFlushQueue, boolean cacheNames) throws SQLException {
		super(dataset, connection, tweaks, useFlushQueue );
		
		referenceSeparator = tweaks.getTweak("dbstore.cacheReferenceSeparator", "\u001E"); //ASCII Record Separator
		referenceFieldSeparator = tweaks.getTweak("dbstore.cacheReferenceFieldSeparator", "\u001F"); //ASCII Field Separator
		languagePrefixSeparator = tweaks.getTweak("dbstore.languagePrefixSeparator", ":"); //ASCII Field Separator
		conceptSeparatorPattern = Pattern.compile(referenceSeparator.replaceAll("[^$(){}\\[\\]\\\\]", "\\\\$0")); 
		conceptFieldSeparatorPattern = Pattern.compile(referenceFieldSeparator.replaceAll("[^$(){}\\[\\]\\\\]", "\\\\$0")); 
		languagePrefixPattern = Pattern.compile(languagePrefixSeparator.replaceAll("[^$(){}\\[\\]\\\\]", "\\\\$0")); 

		langlinkReferenceListEntry = 
			new ConceptListEntrySpec("language, target", "concat(language, ':', target)", 
					LIST_FORMAT_USE_NAME | LIST_FORMAT_USE_LANGUAGE_PREFIX );  
				
		termReferenceListEntry = 
			new ConceptListEntrySpec("term_text", fields("term_text", "freq"), 
					LIST_FORMAT_USE_NAME | LIST_FORMAT_USE_CARDINALITY );

		broaderReferenceListEntry = 
			new ConceptListEntrySpec("broad", cacheNames ? fields("broad", "broad_name", "if (lhs is null or lhs = 0, 0, 1/lhs)") : fields("broad", "if (lhs is null or lhs = 0, 0, 1/lhs)"), 
					LIST_FORMAT_USE_ID | (cacheNames ? LIST_FORMAT_USE_NAME : 0) | LIST_FORMAT_USE_RELEVANCE );
		
		narrowerReferenceListEntry = 
			new ConceptListEntrySpec("narrow", cacheNames ? fields("narrow", "narrow_name", "if (lhs is null or lhs = 0, 0, 1/lhs)") : fields("narrow", "if (lhs is null or lhs = 0, 0, 1/lhs)"), 
					LIST_FORMAT_USE_ID | (cacheNames ? LIST_FORMAT_USE_NAME : 0) | LIST_FORMAT_USE_RELEVANCE);
		
		inLinksReferenceListEntry = 
			new ConceptListEntrySpec("anchor", cacheNames ? fields("anchor", "anchor_name", "idf") : fields("anchor", "idf"), 
					LIST_FORMAT_USE_ID | (cacheNames ? LIST_FORMAT_USE_NAME : 0) | LIST_FORMAT_USE_RELEVANCE );
		
		outLinksReferenceListEntry = 
			new ConceptListEntrySpec("target", cacheNames ? fields("target", "target_name", "idf") : fields("target", "idf"), 
					LIST_FORMAT_USE_ID | (cacheNames ? LIST_FORMAT_USE_NAME : 0) | LIST_FORMAT_USE_RELEVANCE );
			
		similarReferenceListEntry = 
			new ConceptListEntrySpec("concept2", fields("concept2", "langmatch"), //TODO: frequency for similar from langref(!)
					LIST_FORMAT_USE_ID | LIST_FORMAT_USE_CARDINALITY); //TODO: name?... in relation table?... //XXX: why no score
		
		relatedReferenceListEntry = 
			new ConceptListEntrySpec("concept2", "concept2", 
					LIST_FORMAT_USE_ID); //TODO: name?... in relation table?... //XXX: why no score
				
		related2ReferenceListEntry = 
			new ConceptListEntrySpec("concept1","concept1", 
					LIST_FORMAT_USE_ID); //TODO: name?... in relation table?... //XXX: why no score
		
		featureReferenceListEntry = 
			new ConceptListEntrySpec("target",fields("target", "weight"), 
					LIST_FORMAT_USE_ID | LIST_FORMAT_USE_RELEVANCE );
				
		proximityReferenceListEntry = 
			new ConceptListEntrySpec("target",fields("target", "proximity"), 
					LIST_FORMAT_USE_ID | LIST_FORMAT_USE_RELEVANCE );
				
		init(tweaks, description);
	}

	public ConceptInfoStoreSchema(DatasetIdentifier dataset, DataSource connectionInfo, boolean description, TweakSet tweaks, boolean useFlushQueue, boolean cacheNames) throws SQLException {
		this(dataset, connectionInfo.getConnection(), description, tweaks, useFlushQueue, cacheNames);
	}
	
	private void init(TweakSet tweaks, boolean description) throws SQLException {
		
		int listBlobSize = tweaks.getTweak("dbstore.listBlobSize", 255*255); 
		setGroupConcatMaxLen(listBlobSize); //TODO: if it's larger currently, don't shrink!
		
		conceptInfoTable = new EntityTable(this, "concept_info", getDefaultTableAttributes());
		conceptInfoTable.addField( new DatabaseField(this, "concept", "INT", null, true, KeyType.PRIMARY ) );
		conceptInfoTable.addField( new DatabaseField(this, "inlinks", getTextType(listBlobSize), null, false, null ) );
		conceptInfoTable.addField( new DatabaseField(this, "outlinks", getTextType(listBlobSize), null, false, null ) );
		conceptInfoTable.addField( new DatabaseField(this, "narrower", getTextType(listBlobSize), null, false, null ) );
		conceptInfoTable.addField( new DatabaseField(this, "broader", getTextType(listBlobSize), null, false, null ) );
		conceptInfoTable.addField( new DatabaseField(this, "langlinks", getTextType(listBlobSize), null, false, null ) );
		//TODO: inlinks, outlinks, coocc, co-coocc
		conceptInfoTable.setAutomaticField(null);
		conceptInfoTable.addField( new DatabaseField(this, "similar", getTextType(listBlobSize), null, false, null ) );
		conceptInfoTable.addField( new DatabaseField(this, "related", getTextType(listBlobSize), null, false, null ) );
		//TODO: derived
		conceptInfoTable.addField( new DatabaseField(this, "feature", getTextType(listBlobSize), null, false, null ) );
		conceptInfoTable.addField( new DatabaseField(this, "proximity", getTextType(listBlobSize), null, false, null ) );
		addTable(conceptInfoTable);

		if (description) {
			conceptDescriptionTable = new EntityTable(this, "concept_description", getDefaultTableAttributes());
			conceptDescriptionTable.addField( new DatabaseField(this, "concept", "INT", null, true, KeyType.PRIMARY ) );
			conceptDescriptionTable.addField( new DatabaseField(this, "terms", getTextType(listBlobSize), null, false, null ) );
			conceptDescriptionTable.setAutomaticField(null);
			addTable(conceptDescriptionTable);
		}
	}
	
	@Override
	public void checkConsistency() throws SQLException {
		//FIXME: "concept" is not declared to be a reference field, and references an unknown bit
		//checkReferentialIntegrity(conceptInfoTable, "concept", false);   
		//checkReferentialIntegrity(conceptDescriptionTable, "concept", false);   
	}
	
	public boolean hasDescriptions() {
		return conceptDescriptionTable != null;
	}
	
	
	@Override
	public boolean isComplete() throws SQLException {
			if (!super.isComplete()) return false;
			if (!this.tableExists("concept_info")) return false;
			
			String sql = "select count(*) from "+this.getSQLTableName("concept_info");
			int c = ((Number)this.executeSingleValueQuery("isComplete", sql)).intValue();
			if (c == 0) return false; //XXX: hack
			
			return true;
	}
		
}
