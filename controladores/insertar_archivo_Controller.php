<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class insertar_archivo_Controller extends cls_Controller{
	public function __construct($controlador,$metodo) {
        parent::__construct($controlador,$metodo);
        //$_glucemias = $this->loadModel('glucemias');
        
    }
    
    public function index()
    {
		
        $this->_view->titulo = 'Insertar archivo con glucemias';
        //$this->_view->paciente="Carmen Antonia Carreira Rodriguez de la fuente";
        //$this->_view->alert=$this->alert();
        if(isset($_FILES['archivo'])) 
        {    
            $uploadedfileload="true";
            $msg="";
            $uploadedfile_size=$_FILES['archivo']['size'];
            echo $_FILES['archivo']['name'];
            if ($uploadedfile_size>200000)
            {
                $msg=$msg."El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
                $uploadedfileload="false";
            }
            if (!($_FILES['archivo']['type'] =="text/plain"))
            {
                $msg=$msg." Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
                $uploadedfileload="false";
            }
            $destination=__DIR__.'/../uploads/'. $_FILES["archivo"]['name'];
            $target_path=$_FILES['archivo']['tmp_name'];
           //echo "<br>".$destination."<br>".$target_path."<br>".$_FILES['archivo']['error']."<br>";
            
            if($uploadedfileload=="true")
            {              
                if(move_uploaded_file ($target_path,$destination ))
                {
                    $this->_view->mensaje= " Ha sido subido satisfactoriamente";
                    
                }
                else
                {
                   $this->_view->mensaje=" Error al subir el archivo";
                    
                    
                }
            }
            else
            {
                echo $msg;
            }
        }
        $this->_view->renderizar('insertar', 'insertar',$this->_omenu->get_menu());
    }
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    













}
?>