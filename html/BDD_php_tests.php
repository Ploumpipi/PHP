<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>test BDD en  php</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/.png"/>
		<link rel="stylesheet" type="text/css" href="../css/BDD_php_tests.css">
	</head>
    <body>
        <h2>Recherche dans table</h2>
        <?php
        define('USER',"root");
        define('PASSWD',"");
        define('SERVER',"localhost");
        define('BASE',"intranet");

        function connect_bd(){
            $dsn="mysql:dbname=".BASE.";host=".SERVER;
            try{
                $connexion=new PDO($dsn,USER,PASSWD);
            }
            catch(PDOException $e){
                printf("Echec de la connexion : %s\n", $e->getMessage());
                exit();
            }
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connexion;
        }
        $connexion=connect_bd();

        $sql="SELECT id_etudiant, matiere_test, valeur FROM listeNote;";
        //$connexion->query($sql);
        //var_dump($connexion->query($sql));
        foreach($connexion->query($sql) as $row){
            var_dump($row);
        }

        foreach($connexion->query($sql) as $row){
            echo $row['id_etudiant'].' ';
            echo $row['matiere_test'].' ';
            echo $row['valeur'].' <br>';
        }
        //afficher liste des étudiants de la table
        $liste_etudiant="SELECT id_etudiant FROM listeNote;";
        foreach($connexion->query($sql) as $row){
            echo 'etudiant numéro : '.$row['id_etudiant'].' <br>';
        }

        $moyenne="SELECT id_etudiant, AVG(valeur) as moyenne
        FROM listeNote
        group by id_etudiant;";

        foreach($connexion->query($moyenne) as $row){
            echo 'etudiant numéro : '.$row['id_etudiant'].' a la moyenne : '.$row['moyenne'].' <br>';
        }

        $listeEtudiant="SELECT count(distinct id_etudiant) as nb_etudiant
        FROM listeNote;";//SELECT count(distinct id_etudiant) FROM listeNote where id_etudiant = 3;

        var_dump(!$connexion->query($listeEtudiant));
        foreach($connexion->query($listeEtudiant) as $row){
            var_dump($row);//var_dump($row['nb_etudiant']);
        }

        foreach($connexion->query($listeEtudiant) as $row){
            //var_dump($row);
            if($row['nb_etudiant'] == 0){
                echo 'aucun élève trouvé';
            }else{
                echo $row['nb_etudiant'];
            }
        }
        ?>
        <select id="etudiant">
            <option value ="" selected> selectionnez un étudiant
            <?php
            $etudiantUnique="SELECT distinct id_etudiant from listeNote";
                foreach($connexion->query($etudiantUnique) as $row){
                    echo '<option value ='."$row[id_etudiant]".'>'.'étudiant '.$row['id_etudiant'].'</option>';
                }
            ?>
        </select>
        <?php
            $etudiantUnique="SELECT distinct id_etudiant from listeNote";
            var_dump($connexion->query($etudiantUnique));
            if(!$connexion->query($etudiantUnique)){
                echo "soucis de requête";
            }
            //Form de recherche : notes d'un étudiant
            //Select * from notes where id_etudiant = $Post['std'];
        ?>
        <form action="" method="post">
            <label for="std">Étudiant : </label>
            <input type="text" id="std" name="std">
            <input type="submit">
        </form>
        <?php
            if($_POST['std']){
                $notes="SELECT * FROM listeNote WHERE id_etudiant=$_POST[std]";
                $sql="SELECT * FROM listeNote";
                $req=$connexion->query($sql);
                $nb=$req->rowCount();
                $moyenne="SELECT id_etudiant, AVG(valeur) as moyenne
                            FROM listeNote
                            group by id_etudiant
                            WHERE id_etudiant=$_POST[std]";
                //var_dump($connexion->query($notes));
                if($nb==0){
                    echo'<tr>';
                    echo ('<td>---NO DATA FOUND---</td>');
                    echo'</tr>';
                }
                if(!empty($_POST)){
                    echo '<table>';
                    echo '<tr><td>Matière</td><td>Notes</td></tr>';
                    foreach($connexion->query($notes) as $row){
                        echo '<tr>';
                        echo '<td>'.$row['matiere_test'].'</td>';
                        echo '<td>'.$row['valeur'].' </td>';
                        echo '</tr>';
                    }
                    /*echo '<tfoot>';
                    echo '<td>Moyenne</td><td>'.$moyenne['moyenne'].'</td>';
                    echo '</tfoot>';*/

                }                    
            }else{
                $notes="SELECT * FROM listeNote";
                //echo 'id_etudiant, matière, notes <br>';
                echo '<table>';
                echo '<tr><td>Étudiant</td><td>Matière</td><td>Notes</td></tr>';
                foreach($connexion->query($notes) as $row){
                    echo '<tr>';
                    echo '<td>'.$row['id_etudiant'].'</td>';
                    echo '<td>'.$row['matiere_test'].'</td>';
                    echo '<td>'.$row['valeur'].' </td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        ?>
        <form action="" method="post">
            <label for="std">Étudiant : </label>
            <input type="text" id="std" name="std"><br>
            <label for="matière">Matière : </label>
            <input type="text" id="matière" name="matière">
            <input type="submit">
        </form>

        <?php
            if($_POST['std'] && $_POST['matière']){
                $notes="SELECT * FROM listeNote WHERE id_etudiant=$_POST[std] and matiere_test=$_POST[matière]";
                $sql="SELECT * FROM listeNote";
                $req=$connexion->query($sql);
                $nb=$req->rowCount();
                //var_dump($connexion->query($notes));
                if($nb==0){
                    echo'<tr>';
                    echo ('<td>---NO DATA FOUND---</td>');
                    echo'</tr>';
                }
                if(!empty($_POST)){
                    echo '<table>';
                    echo '<tr><td>Matière</td><td>Notes</td></tr>';
                    foreach($connexion->query($notes) as $row){
                        echo '<tr>';
                        echo '<td>'.$row['matiere_test'].'</td>';
                        echo '<td>'.$row['valeur'].' </td>';
                        echo '</tr>';
                    }
                }                    
            }else{
                $notes="SELECT * FROM listeNote";
                //echo 'id_etudiant, matière, notes <br>';
                echo '<table>';
                echo '<tr><td>Étudiant</td><td>Matière</td><td>Notes</td></tr>';
                foreach($connexion->query($notes) as $row){
                    echo '<tr>';
                    echo '<td>'.$row['id_etudiant'].'</td>';
                    echo '<td>'.$row['matiere_test'].'</td>';
                    echo '<td>'.$row['valeur'].' </td>';
                    echo '</tr>';
                }
                echo '</table>';
            }

            //à rendre pour dimanche soir : pouvoir se logger, css qui ont du sens, lier à une bdd, un étudiant a une photo de profil
        ?>
    </body>
</html>