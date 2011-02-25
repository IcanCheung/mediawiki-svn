﻿/**
 * Trasliteration regular expression rules table for Tamil
 * @author Junaid P V ([[user:Junaidpv]])
 * @date 2010-11-21
 * License: GPLv3, CC-BY-SA 3.0
 */

// Normal rules
var rules = [
['ச்h','h','ச்ஹ்',],
['ழ்h','h','ழ்ஹ்',],

 //'(ஸ்ரிi|ஸ்ர்I)', '','',
 
['([க-ஹ])்a', '','$1'],
['([க-ஹ])(்A|a)', '','$1ா'],
['([க-ஹ])்i', '','$1ி'],
['([க-ஹ])(்I|ிi)', '','$1ீ'],
['([க-ஹ])்u', '','$1ு'],
['([க-ஹ])(்U|ுu)', '','$1ூ'],
['([க-ஹ])்e', '','$1ெ'],
['([க-ஹ])(்E|ெe)', '','$1ே'],
['([க-ஹ])i', '','$1ை'],
['([க-ஹ])்o', '','$1ொ'],
['([க-ஹ])(்O|ொo)', '','$1ோ'],
['([க-ஹ])u', '','$1ௌ'],

['([அ-ஹ][ெ-்]?)n', '','$1ன்'],
 
['அa', '','ஆ'],
['இi', '','ஈ'],
['உu', '','ஊ'],
['எe', '','ஏ'],
['அi', '','ஐ'],
['ஒo', '','ஓ'],
['அu', '','ஔ'],
 
['(ந்|ன்)g', '','ங்'],
['(ந்|ன்)j', '','ஞ்'],
['ச்h', '','ச்'],
['ழ்h', '','ழ்'],
['ட்h', '','த்'],
['ஸ்h', '','ஷ்'],
 
['a', '','அ'],
['c', '','ச்'],
['d', '','ட்'],
['e', '','எ'],
['h', '','ஹ்'],
['i', '','இ'],
['j', '','ஜ்'],
['k', '','க்'],
['l', '','ல்'],
['m', '','ம்'],
['n', '','ந்'],
['o', '','ஒ'],
['p', '','ப்'],
['q', '','ஃ'],
['r', '','ர்'],
['s', '','ச்'],
['t', '','ட்'],
['u', '','உ'],
['v', '','வ்'],
['w', '','ந்'],
['y', '','ய்'],
['z', '','ழ்'],
['A', '','ஆ'],

['C', '','க்க்'],
['E', '','ஏ'],
['H', '','ஃ'],
['I', '','ஈ'],
['J', '','ஜ்ஜ்'],
['K', '','க்'],
['L', '','ள்'],
['M', '','ம்ம்'],
['N', '','ண்'],
['O', '','ஓ'],
['P', '','ப்ப்'],
['R', '','ற்'],
['S', '','ஸ்'],
['T', '','ட்'],
['U', '','ஊ'],
['(V|W)', '','வ்வ்'],
['Y', '','ய்ய்'],
['Z', '','ஶ்'],

['~', '','்'],

['\\\\0', '','\u0be6'],
['\\\\1', '','௧'],
['\\\\2', '','௨'],
['\\\\3', '','௩'],
['\\\\4', '','௪'],
['\\\\5', '','௫'],
['\\\\6', '','௬'],
['\\\\7', '','௭'],
['\\\\8', '','௮'],
['\\\\9', '','௯'],
['10\\\\', '','\u0BF0'],
['100\\\\', '','\u0BF1'],
['1000\\\\', '','\u0BF2']
];

jQuery.narayam.addScheme( 'ta', {
	'namemsg': 'narayam-ta',
	'extended_keyboard': false,
	'lookbackLength': 1,
	'rules': rules
} );
