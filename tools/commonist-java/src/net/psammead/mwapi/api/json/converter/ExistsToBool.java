package net.psammead.mwapi.api.json.converter;

import net.psammead.mwapi.api.json.JSONConverter;
import net.psammead.mwapi.api.json.JSONConverterContext;

public final class ExistsToBool implements JSONConverter {
	public Object convert(JSONConverterContext ctx, Object o) { 
		return o != null; 
	}
}
