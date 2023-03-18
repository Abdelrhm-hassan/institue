/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
 	config.language 				= 'en';
    config.filebrowserImageBrowseUrl= '/admin/filemanager?type=Images';
    config.filebrowserImageUploadUrl= '/admin/filemanager/upload?type=Images&_token=';
    config.filebrowserBrowseUrl		= '/admin/filemanager?type=Files';
    config.filebrowserUploadUrl		= '/admin/filemanager/upload?type=Files&_token=';
};
