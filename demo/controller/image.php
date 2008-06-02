<?

// set the file
$file = $this->app . '/image/' . $input->path;

// see if we have the image
if( ! file_exists( $file ) ) return;

// make sure it is an image.
if( ! $img_type = exif_imagetype( $file ) ) return;

// if we can't get the mime type, give up
if( ! $mime_type = image_type_to_mime_type( $img_type ) ) return;

// set the image header
header('Content-Type: ' . $imgtype);

// pass through the contents of the file.
readfile( $file );

// EOF