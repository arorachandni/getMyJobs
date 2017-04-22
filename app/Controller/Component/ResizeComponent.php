<?php
 App::uses('Component', 'Controller');

/**
* Images component for CakePHP.
* @author Amit Chavda <amit.chavda@gmail.com>
* @copyright Amit Chavda
* @link http://www.cakephp.org CakePHP
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.

* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

class ResizeComponent extends Component {
    // Resize any specified jpeg, gif, or png image
    function resize($imagePath, $destinationWidth, $destinationHeight) {
        // The file has to exist to be resized
        if(file_exists($imagePath)) {
            // Gather some info about the image
            $imageInfo = getimagesize($imagePath);
            
            // Find the intial size of the image
            $sourceWidth = $imageInfo[0];
            $sourceHeight = $imageInfo[1];
            
            // Find the mime type of the image
            $mimeType = $imageInfo['mime'];
            
            // Create the destination for the new image
            $destination = imagecreatetruecolor($destinationWidth, $destinationHeight);

            // Now determine what kind of image it is and resize it appropriately
            if($mimeType == 'image/jpg' || $mimeType == 'image/jpeg' || $mimeType == 'image/pjpeg') {
                $source = imagecreatefromjpeg($imagePath);
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                imagejpeg($destination, $imagePath);
            } else if($mimeType == 'image/gif') {
                $source = imagecreatefromgif($imagePath);
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                imagegif($destination, $imagePath);
            } else if($mimeType == 'image/png' || $mimeType == 'image/x-png') {
                $source = imagecreatefrompng($imagePath);
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                imagepng($destination, $imagePath);
            } else {
                $this->_error('This image type is not supported.');
            }
            
            // Free up memory
            imagedestroy($source);
            imagedestroy($destination);
        } else {
            $this->_error('The requested file does not exist.');
        }
    }
    
    // Outputs errors...
    function _error($message) {
        trigger_error('The file could not be resized for the following reason: ' . $message);
    }
	
	
	
	
}
?> 