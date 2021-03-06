<?php

const POP_TEMPLATE_DATALOAD = 'dataload';
const POP_TEMPLATE_BUTTONGROUP = 'buttongroup';
const POP_TEMPLATE_BUTTON = 'button';
const POP_TEMPLATE_BUTTONINNER = 'buttoninner';
const POP_TEMPLATE_WINDOW = 'window';
const POP_TEMPLATE_OFFCANVAS = 'offcanvas';
const POP_TEMPLATE_HTMLCODE = 'htmlcode';
const POP_TEMPLATE_SCRIPTCODE = 'scriptcode';
const POP_TEMPLATE_STYLECODE = 'stylecode';
const POP_TEMPLATE_CONDITIONWRAPPER = 'conditionwrapper';
const POP_TEMPLATE_CONTROL_ANCHOR = 'anchor-control';
const POP_TEMPLATE_CONTROL_BUTTON = 'button-control';
const POP_TEMPLATE_CONTROL_DROPDOWNBUTTON = 'dropdownbutton-control';
const POP_TEMPLATE_CONTROL_RADIOBUTTON = 'radiobutton-control';
const POP_TEMPLATE_CONTROLBUTTONGROUP = 'controlbuttongroup';
const POP_TEMPLATE_CONTROLGROUP = 'controlgroup';
const POP_TEMPLATE_DIVIDER = 'divider';
const POP_TEMPLATE_FETCHMORE = 'fetchmore';
const POP_TEMPLATE_HIDEIFEMPTY = 'hideifempty';
const POP_TEMPLATE_FEEDBACKMESSAGE_INNER = 'feedbackmessage-inner';
// const POP_TEMPLATE_CHECKPOINTMESSAGE_INNER = 'checkpointmessage-inner';
const POP_TEMPLATE_LATESTCOUNT = 'latestcount';
const POP_TEMPLATE_LAYOUT_MAXHEIGHT = 'layout-maxheight';
const POP_TEMPLATE_LAYOUT_CONTENT = 'layout-content';
const POP_TEMPLATE_LAYOUT_LINKCONTENT = 'layout-linkcontent';
const POP_TEMPLATE_LAYOUT_APPENDSCRIPT = 'script-append';
const POP_TEMPLATE_LAYOUT_AUTHOR_CONTACT = 'layout-author-contact';
const POP_TEMPLATE_LAYOUT_AUTHORCONTENT = 'layout-authorcontent';
const POP_TEMPLATE_LAYOUT_CATEGORIES = 'layout-categories';
const POP_TEMPLATE_LAYOUT_COMMENT = 'layout-comment';
const POP_TEMPLATE_LAYOUT_EMBEDPREVIEW = 'layout-embedpreview';
const POP_TEMPLATE_LAYOUT_INITJSDELAY = 'layout-initjs-delay';
const POP_TEMPLATE_LAYOUT_FULLOBJECTTITLE = 'layout-fullobjecttitle';
const POP_TEMPLATE_LAYOUT_FULLVIEW = 'layout-fullview';
const POP_TEMPLATE_LAYOUT_FULLUSER = 'layout-fulluser';
const POP_TEMPLATE_LAYOUT_LATESTCOUNTSCRIPT = 'script-latestcount';
const POP_TEMPLATE_LAYOUT_MARKER = 'layout-marker';
const POP_TEMPLATE_LAYOUT_MENU_ANCHOR = 'layout-menu-anchor';
const POP_TEMPLATE_LAYOUT_MENU_COLLAPSESEGMENTEDBUTTON = 'layout-menu-collapsesegmentedbutton';
const POP_TEMPLATE_LAYOUT_MENU_DROPDOWN = 'layout-menu-dropdown';
const POP_TEMPLATE_LAYOUT_MENU_DROPDOWNBUTTON = 'layout-menu-dropdownbutton';
const POP_TEMPLATE_LAYOUT_MENU_INDENT = 'layout-menu-indent';
const POP_TEMPLATE_LAYOUT_MENU_MULTITARGETINDENT = 'layout-menu-multitargetindent';
const POP_TEMPLATE_LAYOUT_FEEDBACKMESSAGE = 'layout-feedbackmessage';
const POP_TEMPLATE_LAYOUT_MULTIPLE = 'layout-multiple';
const POP_TEMPLATE_LAYOUT_PAGETAB = 'layout-pagetab';
const POP_TEMPLATE_LAYOUT_POPOVER = 'layout-popover';
const POP_TEMPLATE_LAYOUT_POSTADDITIONAL_MULTILAYOUT_LABEL = 'layout-postadditional-multilayout-label';
const POP_TEMPLATE_LAYOUT_POSTSTATUSDATE = 'layout-poststatusdate';
const POP_TEMPLATE_LAYOUT_TAGINFO = 'layout-taginfo';
const POP_TEMPLATE_LAYOUT_POSTTHUMB = 'layout-postthumb';
const POP_TEMPLATE_LAYOUT_PREVIEWPOST = 'layout-previewpost';
const POP_TEMPLATE_LAYOUT_PREVIEWUSER = 'layout-previewuser';
const POP_TEMPLATE_LAYOUT_SCRIPTFRAME = 'layout-scriptframe';
const POP_TEMPLATE_LAYOUT_SEGMENTEDBUTTON_LINK = 'layout-segmentedbutton-link';
const POP_TEMPLATE_LAYOUT_STYLES = 'layout-styles';
const POP_TEMPLATE_LAYOUT_SUBCOMPONENT = 'layout-subcomponent';
const POP_TEMPLATE_LAYOUT_TAG = 'layout-tag';
const POP_TEMPLATE_LAYOUT_USERPOSTINTERACTION = 'layout-userpostinteraction';
const POP_TEMPLATE_LAYOUTPOST_AUTHORNAME = 'layoutpost-authorname';
const POP_TEMPLATE_LAYOUTPOST_DATE = 'layoutpost-date';
const POP_TEMPLATE_LAYOUTPOST_STATUS = 'layoutpost-status';
const POP_TEMPLATE_LAYOUTPOST_TYPEAHEAD_COMPONENT = 'layoutpost-typeahead-component';
const POP_TEMPLATE_LAYOUTPOST_CARD = 'layoutpost-card';
const POP_TEMPLATE_LAYOUTCOMMENT_CARD = 'layoutcomment-card';
const POP_TEMPLATE_LAYOUTSTATIC_TYPEAHEAD_COMPONENT = 'layoutstatic-typeahead-component';
const POP_TEMPLATE_LAYOUTTAG_TYPEAHEAD_COMPONENT = 'layouttag-typeahead-component';
const POP_TEMPLATE_LAYOUTTAG_MENTION_COMPONENT = 'layouttag-mention-component';
const POP_TEMPLATE_LAYOUTUSER_MENTION_COMPONENT = 'layoutuser-mention-component';
const POP_TEMPLATE_LAYOUTUSER_QUICKLINKS = 'layoutuser-quicklinks';
const POP_TEMPLATE_LAYOUTUSER_TYPEAHEAD_COMPONENT = 'layoutuser-typeahead-component';
const POP_TEMPLATE_LAYOUTUSER_CARD = 'layoutuser-card';
const POP_TEMPLATE_MESSAGE = 'message';
const POP_TEMPLATE_SCRIPT_APPENDCOMMENT = 'script-append-comment';
const POP_TEMPLATE_SCRIPT_LAZYLOADINGREMOVE = 'script-lazyloading-remove';
const POP_TEMPLATE_LAYOUT_LAZYLOADINGSPINNER = 'layout-lazyloading-spinner';
const POP_TEMPLATE_SCROLL = 'scroll';
const POP_TEMPLATE_SCROLL_INNER = 'scroll-inner';
const POP_TEMPLATE_SOCIALMEDIA = 'sm'; // Comment Leo: renamed from "socialmedia" to "sm" because AdBlockPlus blocks them
const POP_TEMPLATE_SOCIALMEDIA_ITEM = 'sm-item'; // Comment Leo: renamed from "socialmedia" to "sm" because AdBlockPlus blocks them
const POP_TEMPLATE_STATUS = 'status';
const POP_TEMPLATE_SUBMENU = 'submenu';
const POP_TEMPLATE_TABLE = 'table';
const POP_TEMPLATE_TABLE_INNER = 'table-inner';
const POP_TEMPLATE_VIEWCOMPONENT_BUTTON = 'viewcomponent-button';
const POP_TEMPLATE_VIEWCOMPONENT_HEADER_COMMENTCLIPPED = 'viewcomponent-header-commentclipped';
const POP_TEMPLATE_VIEWCOMPONENT_HEADER_COMMENTPOST = 'viewcomponent-header-commentpost';
const POP_TEMPLATE_VIEWCOMPONENT_HEADER_POST = 'viewcomponent-header-post';
const POP_TEMPLATE_VIEWCOMPONENT_HEADER_REPLYCOMMENT = 'viewcomponent-header-replycomment';
const POP_TEMPLATE_VIEWCOMPONENT_HEADER_USER = 'viewcomponent-header-user';
const POP_TEMPLATE_VIEWCOMPONENT_HEADER_TAG = 'viewcomponent-header-tag';
const POP_TEMPLATE_WIDGET = 'widget';
