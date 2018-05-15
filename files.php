<?php

$filePath = $_GET['filePath'];

// Define a function to output files in a directory
function outputFiles($path){
    // Check directory exists or not
    if(file_exists($path) && is_dir($path)){
        // Scan the files in this directory
        $result = scandir($path);
        // Filter out the current (.) and parent (..) directories
        $files = array_diff($result, array('.', '..'));
        
            // Loop through retuned array
            foreach($files as $file){
//                echo $file."<Br>";
                if(is_file("$path/$file")){
                    // Display filename
                    echo $file . "<br>";
                } else if(is_dir("$path/$file")){
                    // Recursively call the function if directories found
                    //outputFiles("$path/$file");
                    echo "<a href='files.php?filePath=$path/$file' style='text-decoration:none;'><font color='red'>".$file."</font></a><br>";
                }
            }
            die();

    } else {
        echo "ERROR: The directory does not exist.";
    }
}
 
// Call the function
outputFiles($filePath);
?>