<?php
 class imageValidation{
     public function verifyImage($fileName, $tempPath, $fileSize){
        if(empty($fileName))
        {
            $errorMSG = json_encode(array("message" => "please select image", "status" => false));	
            return $errorMSG;
        }
        else
        {
            $upload_path = 'upload/'; // set upload folder path 
            
            $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
                
            // valid image extensions
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
                            
            // allow valid image file formats
            if(in_array($fileExt, $valid_extensions))
            {				
                //check file not exist our upload folder path
                if(!file_exists($upload_path . $fileName))
                {
                    // check file size '5MB'
                    if($fileSize < 5000000){
                        move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
                    }
                    else{		
                        $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));	
                        return $errorMSG;
                    }
                }
                else
                {		
                    $errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));	
                    return $errorMSG;
                }
            }
            else
            {		
                $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));	
                return $errorMSG;		
            }
        }

     }
 }
?>