{
    open Parser
    open Render_info
    open Tex
}
let space = [' ' '\t' '\n' '\r']
let alpha = ['a'-'z' 'A'-'Z']
let literal_it = ['a'-'z' 'A'-'Z']
let literal_rm = ['0'-'9']
let literal_uf = ['+' '-' '*' ',' '=' '(' ')' ':' '/' ';' '?' '.' '!'  '|' '\'' ]
let boxchars  = ['0'-'9' 'a'-'z' 'A'-'Z' '+' '-' '*' ',' '=' '(' ')' ':' '/' ';' '?' '.' '!' ' ' '\128'-'\255']
let aboxchars = ['0'-'9' 'a'-'z' 'A'-'Z' '+' '-' '*' ',' '=' '(' ')' ':' '/' ';' '?' '.' '!' ' ']

rule token = parse
    space +			{ token lexbuf }
  | "\\mbox" space * '{' aboxchars + '}'
				{ let str = Lexing.lexeme lexbuf in
				  let n = String.index str '{' + 1 in
				  BOX ("\\mbox", String.sub str n (String.length str - n - 1)) }
  | "\\hbox" space * '{' aboxchars + '}'
				{ let str = Lexing.lexeme lexbuf in
				  let n = String.index str '{' + 1 in
				  BOX ("\\hbox", String.sub str n (String.length str - n - 1)) }
  | "\\vbox" space * '{' aboxchars + '}'
				{ let str = Lexing.lexeme lexbuf in
				  let n = String.index str '{' + 1 in
				  BOX ("\\vbox", String.sub str n (String.length str - n - 1)) }
  | "\\mbox" space * '{' boxchars + '}'
				{ let str = Lexing.lexeme lexbuf in
				  let n = String.index str '{' + 1 in
				  Texutil.tex_use_nonascii();
				  BOX ("\\mbox", String.sub str n (String.length str - n - 1)) }
  | "\\hbox" space * '{' boxchars + '}'
				{ let str = Lexing.lexeme lexbuf in
				  let n = String.index str '{' + 1 in
				  Texutil.tex_use_nonascii();
				  BOX ("\\hbox", String.sub str n (String.length str - n - 1)) }
  | "\\vbox" space * '{' boxchars + '}'
				{ let str = Lexing.lexeme lexbuf in
				  let n = String.index str '{' + 1 in
				  Texutil.tex_use_nonascii();
				  BOX ("\\vbox", String.sub str n (String.length str - n - 1)) }
  | literal_it			{ let str = Lexing.lexeme lexbuf in LITERAL (HTMLABLEC (FONT_IT, str,str)) }
  | literal_rm			{ let str = Lexing.lexeme lexbuf in LITERAL (HTMLABLEC (FONT_RM, str,str)) }
  | literal_uf			{ let str = Lexing.lexeme lexbuf in LITERAL (HTMLABLEC (FONT_UFH, str,str)) }
  | "\\" alpha + 		{ Texutil.find (Lexing.lexeme lexbuf) }
  | "\\sqrt" space * "["	{ FUN_AR1opt "\\sqrt" }
  | "\\," 			{ LITERAL (HTMLABLE (FONT_UF, "\\,","&nbsp;")) }
  | "\\ " 			{ LITERAL (HTMLABLE (FONT_UF, "\\ ","&nbsp;")) }
  | "\\;" 			{ LITERAL (HTMLABLE (FONT_UF, "\\;","&nbsp;")) }
  | "\\!" 			{ LITERAL (TEX_ONLY "\\!") }
  | "\\{" 			{ LITERAL (HTMLABLEC(FONT_UFH,"\\{","{")) }
  | "\\}" 			{ LITERAL (HTMLABLEC(FONT_UFH,"\\}","}")) }
  | "\\|" 			{ LITERAL (HTMLABLE (FONT_UFH,"\\|","||")) }
  | "\\_" 			{ LITERAL (HTMLABLEC(FONT_UFH,"\\_","_")) }
  | "\\#" 			{ LITERAL (HTMLABLE (FONT_UFH,"\\#","#")) }
  | "\\%"			{ LITERAL (HTMLABLE (FONT_UFH,"\\%","%")) }
  | "&"				{ NEXT_CELL }
  | "\\\\"			{ NEXT_ROW }
  | "\\begin{pmatrix}"		{ Texutil.tex_use_ams(); BEGIN_PMATRIX }
  | "\\end{pmatrix}"		{ END_PMATRIX }
  | "\\begin{bmatrix}"		{ Texutil.tex_use_ams(); BEGIN_BMATRIX }
  | "\\end{bmatrix}"		{ END_BMATRIX }
  | "\\begin{Bmatrix}"		{ Texutil.tex_use_ams(); BEGIN_BBMATRIX }
  | "\\end{Bmatrix}"		{ END_BBMATRIX }
  | "\\begin{vmatrix}"		{ Texutil.tex_use_ams(); BEGIN_VMATRIX }
  | "\\end{vmatrix}"		{ END_VMATRIX }
  | "\\begin{Vmatrix}"		{ Texutil.tex_use_ams(); BEGIN_VVMATRIX }
  | "\\end{Vmatrix}"		{ END_VVMATRIX }
  | '>'				{ LITERAL (HTMLABLEC(FONT_UFH,">","&gt;")) }
  | '<'				{ LITERAL (HTMLABLEC(FONT_UFH,"<","&lt;")) }
  | '%'				{ LITERAL (HTMLABLEC(FONT_UFH,"\\%","%")) }
  | '~'				{ LITERAL (HTMLABLE (FONT_UF, "~","&nbsp;")) }
  | '['				{ LITERAL (HTMLABLEC(FONT_UFH,"[","[")) }
  | ']'				{ SQ_CLOSE }
  | '{'				{ CURLY_OPEN }
  | '}'				{ CURLY_CLOSE }
  | '^'				{ SUP }
  | '_'				{ SUB }
  | eof				{ EOF }
