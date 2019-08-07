<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<p>'.$mess.'</p>
   <p>Cliquez <a href="../index.php">ici</a> pour revenir à la page d\'accueil</p></div></body></html>');
}

function insertStaff($conn)
{


  /*  // Les vérifs se font dans trombiback.php eventuellement penser à mixer les 2 



  $res = $conn->prepare("SELECT email FROM staff ");
  $res->execute();
  $resultlistMail = $res->fetchall();
  $error = array();

  foreach ($resultlistMail as $key ) {

    if ($_POST['email'] == $key['email']) {
        $error[] = "doublon";
    }

  }
  */

      $query=$conn->prepare('
      INSERT INTO 
      staff 
      (name, firstname, job, email, tel_ext, tel_int, off_nbr, serv_id)
      VALUES 
      (:name, :firstname, :job, :email, :tel_ext, :tel_int, :off_nbr, :serv_id)');    

      $query->bindValue(':name',$_POST['name'], PDO::PARAM_STR);
      $query->bindValue(':firstname',$_POST['firstname'], PDO::PARAM_STR);
      $query->bindValue(':job',$_POST['job'], PDO::PARAM_STR);
      $query->bindValue(':email',$_POST['email'], PDO::PARAM_STR);
      $query->bindValue(':tel_ext',$_POST['telext'], PDO::PARAM_STR);
      $query->bindValue(':tel_int',$_POST['telint'], PDO::PARAM_STR);
      $query->bindValue(':off_nbr',$_POST['offnbr'], PDO::PARAM_STR);
      $query->bindValue(':serv_id',$_POST['serv_id'], PDO::PARAM_INT);
      $query->execute();


      $last_id = $conn->lastInsertId(); 


      return $last_id;


}

function updateStaff($conn, $post) // update les infos d'un membre du personnel via le formulaire de la page modifierStaff.php
{


  $query=$conn->prepare('
  UPDATE
  staff 
  SET name = :name , firstname = :firstname, job = :job, email = :email, tel_ext = :tel_ext, tel_int = :tel_int, off_nbr = :off_nbr, serv_id = :serv_id
  WHERE
  id = :id 
  ');    

  $query->bindValue(':name',$post['name'], PDO::PARAM_STR);
  $query->bindValue(':firstname',$post['firstname'], PDO::PARAM_STR);
  $query->bindValue(':job',$post['job'], PDO::PARAM_STR);
  $query->bindValue(':email',$post['email'], PDO::PARAM_STR);
  $query->bindValue(':tel_ext',$post['telext'], PDO::PARAM_STR);
  $query->bindValue(':tel_int',$post['telint'], PDO::PARAM_STR);
  $query->bindValue(':off_nbr',$post['offnbr'], PDO::PARAM_STR);
  $query->bindValue(':serv_id',$post['serv_id'], PDO::PARAM_INT);
  $query->bindValue(':id',$post['staff_id'], PDO::PARAM_INT);
  $query->execute();
}

function showDivMeres($conn) // toutes les mères originelles (divisions sans divisions mères)
{

   // $reponse = $conn->prepare('SELECT * FROM service WHERE div_id IS NULL ORDER BY id DESC');  
    $reponse = $conn->prepare('SELECT * FROM service WHERE div_id IS NULL ORDER BY id DESC');  
    $reponse->execute();
    $divMeres = $reponse->fetchall();  



    return $divMeres; 
   
}

function testmere($conn) // toutes les mères -- Pas utilisé pour le moment
{

   // $reponse = $conn->prepare('SELECT * FROM service WHERE div_id IS NULL ORDER BY id DESC');  
    $reponse = $conn->prepare('
      SELECT * FROM service 
      WHERE id in (
      SELECT div_id
      FROM service )
      ');  

    $reponse->execute();
    $divMeres = $reponse->fetchall();  



    return $divMeres; 
   
}
  
function showDivFilles($conn)// toutes les filles
{

  $reponse = $conn->prepare('SELECT * FROM service WHERE div_id IS NOT NULL ORDER BY order_prio');   
  $reponse->execute();
  $divFilles = $reponse->fetchall(); 

  return $divFilles; 

}

function fillesParMere($conn, $mere)// Filles par meres
{

  $reponse = $conn->prepare('SELECT * FROM service WHERE div_id = :div_id');   

  $reponse->bindValue(':div_id', $mere, PDO::PARAM_INT);  
  $reponse->execute();
  $divFillesParMere = $reponse->fetchall(); 

  return $divFillesParMere; 

}

function divMere($conn, $mere)// fille de $mere 
{

  $reponse = $conn->prepare('SELECT * FROM service WHERE id=:id AND div_id IS NULL');   
  $reponse->bindValue(':id' ,$mere, PDO::PARAM_INT);
  $reponse->execute();
  $divMere = $reponse->fetch();   
 

  return $divMere; 

}

function showStaff($conn) // affiche tous les utilisateurs et leurs infos
{

  $reponse = $conn->prepare(' 

  SELECT staff.id, staff.name, staff.firstname, staff.job, staff.email, staff.tel_ext, staff.tel_int, staff.serv_id, staff.off_nbr, staff.add_date, service.off_name, service.descr, service.div_id, pictures.picture 
  FROM staff 
  INNER JOIN service ON staff.serv_id = service.id 
  LEFT JOIN pictures ON staff.id = pictures.staff_id 
  WHERE serv_id IS NOT NULL 
  ORDER BY name ASC');   
  $reponse->execute();
  $staffList = $reponse->fetchall(); 

  return $staffList; 

}


function getUser($conn, $userId) // affiche un utilisateur et leurs infos
{

  $reponse = $conn->prepare('

    SELECT staff.id, staff.name, staff.firstname, staff.job, staff.email, staff.tel_ext, staff.tel_int, staff.serv_id, staff.off_nbr, service.off_name, service.descr, pictures.picture 
    FROM staff 
    INNER JOIN service ON staff.serv_id = service.id 
    LEFT JOIN pictures ON staff.id = pictures.staff_id 
    WHERE serv_id IS NOT NULL AND staff.id = :staff_id 
    ORDER BY serv_id ASC'); 

  $reponse->bindValue(':staff_id', $userId, PDO::PARAM_INT);  
  $reponse->execute();
  $userInfos = $reponse->fetch(); 

  return $userInfos; 

}

function searchUser($conn, $search){ // fonction de recherche via le form de recherche

  $reponse = $conn->prepare('

  SELECT staff.id, staff.name, staff.firstname, staff.job, staff.email, staff.tel_ext, staff.tel_int, staff.serv_id, staff.off_nbr, service.off_name, service.descr, pictures.picture 
  FROM staff 
  INNER JOIN service ON staff.serv_id = service.id 
  LEFT JOIN pictures ON staff.id = pictures.staff_id 
  WHERE serv_id IS NOT NULL 
  AND 
  staff.name LIKE % :search %  
  OR
  staff.firstname LIKE % :search %  
  ORDER BY staff.name ASC'); 

  $reponse->bindValue(':search', $search, PDO::PARAM_STR);  
  $reponse->execute();
  $userInfos = $reponse->fetch(); 

  return $userInfos; 


}

function addPicture($conn, $staff_id){ //ajoute une photo à un utilisateur

  if (isset($_POST['croppedPicture'])&& !empty($_POST['croppedPicture']) && $_POST['croppedPicture']!="" && $_FILES['imgSrc']['size'] != 0) { // Si on a rentré une photo

    $data = $_POST['croppedPicture'];

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);

    $data = base64_decode($data);
    $imageName = time().'.png';
    file_put_contents('../img/'.$imageName, $data); // on la rentre dans le dossier img
  }
  else{ // sinon, photo par défaut
    $imageName = "default.png";
  }

 

  $reponse = $conn->prepare('INSERT INTO pictures(picture, staff_id) VALUES (:photo, :staff_id)');

  $reponse->bindValue(':photo', $imageName, PDO::PARAM_STR);
  $reponse->bindValue(':staff_id', $staff_id, PDO::PARAM_INT);
  $reponse->execute();

  //echo '<p style="color:green;">Photo ajoutée !</p>';
        
}

function pictureExist($conn, $staff_id){ // Vérifie si un utilisateur a déjà une photo

  $res = $conn->prepare("SELECT * FROM pictures WHERE 
              staff_id = :id ");
  $res->bindValue(':id', $staff_id, PDO::PARAM_INT);
  $res->execute();
  $pictureExist = $res->fetchall();

  return $pictureExist;

}



function updatePicture($conn, $staff_id){ // modifie la photo d'un utilisateur

  $data = $_POST['croppedPicture'];
  list($type, $data) = explode(';', $data);
  list(, $data)      = explode(',', $data);
  $data = base64_decode($data);
  $imageName = time().'.png';
  file_put_contents('../img/'.$imageName, $data);


  $reponse = $conn->prepare('
    UPDATE pictures 
    SET picture = :photo 
    WHERE 
    staff_id = :id 
    ');
  $reponse->bindValue(':photo', $imageName, PDO::PARAM_STR);
  $reponse->bindValue(':id', $staff_id, PDO::PARAM_INT);
  $reponse->execute();

  

     
}


function deleteUser($conn, $userId){ // suppr un utilisateur de la table staff

  $reponse = $conn->prepare('
    DELETE FROM staff WHERE id = :id 
  ');

  $reponse->bindValue(':id', $userId, PDO::PARAM_INT);

  $reponse->execute();

}


function deleteUserPicture($conn, $userId){ // supprime le chemin de la photo de la base /// (ajouter suppr définitive photo ?)

  $reponse = $conn->prepare('
    DELETE FROM pictures WHERE staff_id = :id 
  ');

  $reponse->bindValue(':id', $userId, PDO::PARAM_INT);

  $reponse->execute();


}


function resetUserPicture($conn, $userId){ // remplace la photo par la photo par défaut -> si on veut supprimer la photo sans supprimer l'utlisateur

  $imageName = "default.png";
  $reponse = $conn->prepare('
  UPDATE pictures 
  SET picture = :photo 
  WHERE 
  staff_id = :id 
  ');
  $reponse->bindValue(':photo', $imageName, PDO::PARAM_STR);
  $reponse->bindValue(':id', $userId, PDO::PARAM_INT);
  $reponse->execute();


}



function getUserPicture($conn, $userId){ // va chercher la photo du user




  $reponse = $conn->prepare('SELECT picture FROM pictures WHERE staff_id = :staff_id');   

  $reponse->bindValue(':staff_id', $userId, PDO::PARAM_INT);  
  $reponse->execute();
  $Userpic = $reponse->fetch(); 

  return $UserPic; 


}




?>