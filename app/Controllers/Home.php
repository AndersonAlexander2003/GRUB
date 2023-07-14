<?php

namespace App\Controllers;
// use App\Models

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    } 
    

    public function prueba ()
    {
        echo 'hola esto es una prueba';
    }

    public function api()
    {
        $DeporteNoticias = array(
            array(
                "Encabezado de la noticia" => "Muere Luis Suárez Miramontes, leyenda del fútbol y primer Balón de Oro español ",
                "Detalles relevantes" => "Luis Suárez, leyenda del fútbol español, falleció a los 88 años en Milán. Ganó el Balón de Oro en 1960 y jugó en el Inter de Milán. Su talento inspiró a generaciones..",
                "Fecha de referencia" => "2023-07-09",
                "Fuente de información" => "Infobae",
                "Enlace de referencia" => "https://www.infobae.com/espana/2023/07/09/muere-luis-suarez-miramontes-leyenda-del-futbol-espanol-al-que-dio-su-unico-balon-de-oro/"
            ),
            array(
                "Encabezado de la noticia" => "El vestuario del PSG se harta de Mbappé, según RMC",
                "Detalles relevantes" => " Según este medio francés, seis jugadores de la plantilla han enviado una carta quejándose de las declaraciones del delantero francés.",
                "Fecha de referencia" => "2023-07-08",
                "Fuente de información" => "Marca",
                "Enlace de referencia" => "https://www.marca.com/futbol/real-madrid/2023/07/08/64a95bd222601d2f7a8b456c.html"
            ),
            array(
                "Encabezado de la noticia" => "El crudo análisis de Ronaldo sobre el fútbol brasileño y el ejemplo de Vinícius Jr: “No lo prepararon de la forma correcta” ",
                "Detalles relevantes" => "El ex goleador del Real Madrid y actual presidente de Cruzeiro aseguró que durante muchos años en su país no se formaron a los juveniles de manera correcta .",
                "Fecha de referencia" => "2023-07-07",
                "Fuente de información" => "Infobae",
                "Enlace de referencia" => "https://www.infobae.com/deportes/2023/07/07/el-crudo-analisis-de-ronaldo-sobre-el-futbol-brasileno-y-el-ejemplo-de-vinicius-jr-no-lo-prepararon-de-la-forma-correcta/"
            )
        );
    
        return $this->response->setJSON($DeporteNoticias);
    }
    

    public function login(){

return view('login');
    
    }


    public function testbd()
    {
       $this->db = \Config\Database::connect();
    
       $query = $this->db->query("SELECT id, asunto, informacion, fecha, origen, url
                          FROM deportes");

        $result = $query->getResult();
        return $this->response->setJSON($result);
    }
    
    

    public function actualizarDato($id)
    {
        $data = $this->request->getJSON(true); 
        
        $db = \Config\Database::connect();
        $db->table('deportes')->set($data)->where('id', $id)->update();
        
    
        $response = [
            'message' => 'Actualizado satisfactoriamente'
        ];
        
        return $this->response->setJSON($response);
    }
    
    
    
 public function borrardatos($id)
 {
     $db = \Config\Database::connect();
 
     // Eliminar el dato segun el ID
     $db->table('deportes')->where('id', $id)->delete();
 
     $response = [
         'message' => 'Borrado satisfactoriamente'
     ];
 
     return $this->response->setJSON($response);
 }

 public function agregar_un_dato()
 {
     $data = $this->request->getJSON(true);
 
  
     $db = \Config\Database::connect();
     $db->table('deportes')->set($data)->insert();
 
  
     $response = [
         'message' => 'Agregado satisfactoriamente'
     ];
 
     return $this->response->setJSON($response);
 }
 

}





//Actaulizar los datos:  http://localhost/ci4/actualizar_un_dato/1  
//El 1 respresenta el id que se de desea actualizar.


//Borrar datos: http://localhost/ci4/testbd/1
////El 1 respresenta el id que se de desea eliminar.

//Agregar datos: http://localhost/ci4/testbd/agregar_un_dato


/*
{
    "id": "1",
    "asunto": "Muerte de Luis Suárez Miramontes, leyenda del fútbol y primer Balón de Oro español",
    "informacion": "Luis Suárez, leyenda del fútbol español, falleció a los 88 años en Milán. Ganó el Balón de Oro en 1960 y jugó en el Inter de Milán. Su talento inspiró a generaciones..",
    "fecha": "2023-07-09",
    "origen": "Infobae",
    "url": "https://www.infobae.com/espana/2023/07/09/muere-luis-suarez-miramontes-leyenda-del-futbol-espanol-al-que-dio-su-unico-balon-de-oro/"
}
*/