#include <antlr3defs.h>
#include <mwparsercontext.h>
#include <mwformats.h>

static void beginItalic(MWPARSERCONTEXT *context, pANTLR3_VECTOR attr);
static void endItalic(MWPARSERCONTEXT *context);
static void beginBold(MWPARSERCONTEXT *context, pANTLR3_VECTOR attr);
static void endBold(MWPARSERCONTEXT *context);

static void
beginItalic(MWPARSERCONTEXT *context, pANTLR3_VECTOR attr)
{
    context->inShortItalic = true;
    MW_DELAYED_CALL(        context, beginItalic, endItalic, attr, NULL);
    MW_BEGIN_ORDERED_FORMAT(context, beginItalic, endItalic, attr, NULL, true);
    MWLISTENER *l = &context->listener;
    if (!context->inLongItalic) {
        l->beginItalic(l, attr);
    }
}

static void
endItalic(MWPARSERCONTEXT *context)
{
    context->inShortItalic = false;
    MW_SKIP_IF_EMPTY(     context, beginItalic, endItalic, NULL);
    MW_END_ORDERED_FORMAT(context, beginItalic, endItalic, NULL);
    MWLISTENER *l = &context->listener;
    if (!context->inLongItalic) {
        l->endItalic(l);
    }
}

static void
beginBold(MWPARSERCONTEXT *context, pANTLR3_VECTOR attr)
{
    context->inShortBold = true;
    MW_DELAYED_CALL(        context, beginBold, endBold, attr, NULL);
    MW_BEGIN_ORDERED_FORMAT(context, beginBold, endBold, attr, NULL, true);
    MWLISTENER *l = &context->listener;
    if (!context->inLongBold) {
        l->beginBold(l, attr);
    }
}

static void
endBold(MWPARSERCONTEXT *context)
{
    context->inShortBold = false;
    MW_SKIP_IF_EMPTY(     context, beginBold, endBold, NULL);
    MW_END_ORDERED_FORMAT(context, beginBold, endBold, NULL);
    MWLISTENER *l = &context->listener;
    if (!context->inLongBold) {
        l->endBold(l);
    }
}

static void
onNowiki(MWPARSERCONTEXT *context, pANTLR3_STRING nowiki)
{
    MW_TRIGGER_DELAYED_CALLS(context);
    MWLISTENER *l = &context->listener;
    l->onNowiki(l, nowiki);
}

static void
onHorizontalRule(MWPARSERCONTEXT *context, pANTLR3_VECTOR attr)
{
    MW_TRIGGER_DELAYED_CALLS(context);
    MWLISTENER *l = &context->listener;
    l->onHorizontalRule(l, attr);
}

static void
beginPre(MWPARSERCONTEXT *context, pANTLR3_VECTOR attr)
{
    MWLISTENER *l = &context->listener;
    l->beginPre(l, attr);
}

static void
endPre(MWPARSERCONTEXT *context)
{
    MWLISTENER *l = &context->listener;
    l->endPre(l);
}

void
mwFormatsInit(MWPARSERCONTEXT *context)
{
    context->inShortItalic            = false;
    context->inShortBold              = false;

    context->beginItalic              = beginItalic;
    context->endItalic                = endItalic;
    context->beginBold                = beginBold;
    context->endBold                  = endBold;
    context->beginPre                 = beginPre;
    context->endPre                   = endPre;
    context->onNowiki                 = onNowiki;
    context->onHorizontalRule         = onHorizontalRule;
}
