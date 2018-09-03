/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config )
{
    config.filebrowserBrowseUrl = '/backend/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = '/backend/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = '/backend/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = '/backend/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = '/backend/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = '/backend/kcfinder/upload.php?type=flash';
};