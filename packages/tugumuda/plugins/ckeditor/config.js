/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = '/blog/packages/upload/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = '/blog/packages/upload/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = '/blog/packages/upload/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = '/blog/packages/upload/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = '/blog/packages/upload/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = '/blog/packages/upload/kcfinder/upload.php?type=flash';
	config.toolbar_MyToolbar =
	[
		{ name: 'document', items : [ 'NewPage','Preview','Source' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'
                 ,'Iframe' ] },
                '/',
		{ name: 'styles', items : [ 'Styles','Format' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'JustifyBlock','NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'tools', items : [ 'Maximize','-','About' ] }
	];
	config.toolbar_Image =
	[
		{ name: 'insert', items : [ 'Image' ] }
	];
};
