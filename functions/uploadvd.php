<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['profile']) || isset($_POST['post'])){
        $filename = basename($_FILES["fileUpload"]["name"]);
        $filetype = pathinfo($filename, PATHINFO_EXTENSION); // get file extension and check its type.
        if($filetype != "wav" && $filetype != "mp4" && $filetype != "mov" && $filetype != "wmv" && $filetype !="mp3"){
            echo 'Only WAV, MP3, MP4, MOV & WMV formats are allowed.';
        }
        if(exif_imagetype($_FILES["fileUpload"]["tmp_name"])){ // Check if the file is actually an image.
            if(isset($_POST['profile'])){
                $success = 0;
                $filepath = "data/images/profiles/" . $_SESSION['user_id'] . '.' . $filetype;
                if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $filepath)){
                    $sql5 = "INSERT INTO video (video_caption, video_public, video_time, video_by)
                            VALUES ('" . $row['user_firstname'] . " " . $row['user_lastname'] . " has changed his profile picture.', 'N', NOW(), {$_SESSION['user_id']})";
                    $query5 = mysqli_query($conn, $sql5);
                    $last_id = mysqli_insert_id($conn);
                    $filepath2 = "data/video/" . $last_id . '.' . $filetype;
                    copy($filepath, $filepath2);
                    if(!$query5)
                        echo mysqli_error($conn);
                    else
                        $success = 1;

                }
                if($success = 1)
                    header("location:profile.php?id=" . $_SESSION['user_id']);
            }
            else if(isset($_POST['post'])){
                $filepath = "data/video/" . $last_id . '.' . $filetype;
                if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $filepath)){
                    header("refresh:5; url=video.php");
                }
            }
        }
    }
}
?>