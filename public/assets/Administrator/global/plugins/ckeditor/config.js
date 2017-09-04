/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
 // config.language = 'fr';
 // config.uiColor = '#f47622';
 // config.extraPlugins = 'image';
 // config.extraPlugins = 'uploadimage';
 // config.extraPlugins = 'uploadwidget';
 // config.uploadUrl = '/upload_image';
 // Construct path to file upload route
 // Useful if your dev and prod URLs are different
 // var path = CKEDITOR.basePath.split('/');
 // path[ path.length-2 ] = 'upload_image';
 // config.filebrowserUploadUrl = path.join('/').replace(/\/+$/, '');
 //
 // // Add plugin
 // config.extraPlugins = 'filebrowser';
 // config.extraPlugins = 'imageuploader';
 // config.filebrowserBrowseUrl = 'http://localhost/workspace/smartmoney-gg/public/assets/global/plugins/ckeditor/plugins/imageuploader/imgbrowser.php';

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.filebrowserBrowseUrl = '/workspace/smartmoney-gg/public/assets/global/plugins/kcfinder/browse.php?opener=ckeditor&type=files';

	config.filebrowserImageBrowseUrl = '/workspace/smartmoney-gg/public/assets/global/plugins/kcfinder/browse.php?opener=ckeditor&type=images';

	config.filebrowserFlashBrowseUrl = '/workspace/smartmoney-gg/public/assets/global/plugins/kcfinder/browse.php?opener=ckeditor&type=flash';

	config.filebrowserUploadUrl = '/workspace/smartmoney-gg/public/assets/global/plugins/kcfinder/upload.php?opener=ckeditor&type=files';

	config.filebrowserImageUploadUrl = '/workspace/smartmoney-gg/public/assets/global/plugins/kcfinder/upload.php?opener=ckeditor&type=images';

	config.filebrowserFlashUploadUrl = '/workspace/smartmoney-gg/public/assets/global/plugins/kcfinder/upload.php?opener=ckeditor&type=flash';

	// config.extraPlugins = 'imageuploader';

	config.toolbar = [
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
            { name: 'styles', items: [ 'Styles', 'Format' ] },
						{ name: 'insert', items: [ 'Image']},
        ];
};
