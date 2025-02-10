<?php
	    include_once("../classes/conect.php");
        $obj = new conect();
        $resultado = $obj->conectarBanco();
		
		$sql = "SELECT * FROM chat order by  id_chat DESC limit 10;";

        $query = $resultado->prepare($sql);
        $indice = 0;
        if($query->execute())
        {
            while($linha = $query->fetch(PDO::FETCH_ASSOC))
            {
                $linhas[$indice] = $linha;
                echo "<h3>".$linhas[$indice]['nome']."</h3>";
				echo "<p>".$linhas[$indice]['msg']."</p>";
				$indice++;
				
            }
		}
?>