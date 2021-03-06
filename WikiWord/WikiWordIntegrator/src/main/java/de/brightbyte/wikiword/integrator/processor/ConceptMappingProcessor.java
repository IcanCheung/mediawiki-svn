package de.brightbyte.wikiword.integrator.processor;

import de.brightbyte.data.cursor.DataCursor;
import de.brightbyte.util.PersistenceException;
import de.brightbyte.wikiword.integrator.data.MappingCandidates;

public interface ConceptMappingProcessor  extends WikiWordProcessor {
		public void processMappings(DataCursor<MappingCandidates> cursor) throws PersistenceException;
}
