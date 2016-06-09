<?php

class Connect{
   
   private $host,
           $dbname,
           $user,
           $pass,
           $conn,
           $db,
           $query,
           $result,
           $output,
           $search,
           $q,
           $total,
           $start,
           $final,
           $data;

	    public function __construct(){

	    	 $this->host = '127.0.0.1';
	         $this->dbname = 'mzini';
	         $this->user = 'root';
	         $this->pass = '';
	      
	    }
	  
	    private function connection(){

	    	try{
	          $this->conn = new PDO('mysql:host=' .$this->host. ';dbname='.$this->dbname, $this->user, $this->pass);

		    }catch(PDOException $error){
		        echo "Could Not Connect To Database <br />";
		        echo $error->getMessage();
		    }

	      return $this->conn;
	    }
        
        public function search_term(){

	    	if(isset($_GET['q'])){
                
                $this->search = $_GET['q'];
	    	}
                if(mb_strlen($this->search === 0)){
                	return false;
                }else{
	    		    return $this->search;
	    		}
	    }

	    private function sanitizeInput(){

	    	$this->data = $this->search_term();

	    	$this->data = trim($this->data);
			$this->data = stripslashes($this->data);
			$this->data = htmlspecialchars($this->data);
				
			return $this->data;
	    }
	    

	    private function my_query(){
	        
	        $this->q = $this->sanitizeInput();
	        $this->db = $this->connection();

	        $this->query = "SELECT * FROM lost_and_found WHERE MATCH(keywords) AGAINST( '$this->q' IN NATURAL LANGUAGE MODE)";
	        $this->result = $this->db->query($this->query);

	        return $this->result;
	    }


	    public function results(){
           
           $this->output = $this->my_query();

	    	foreach($this->output->fetchAll(PDO::FETCH_OBJ) as $row){
                     echo "<p id='name'> Holder's Name: " .$row->name. "<br /><p>";
                     echo "<p id='serial'> Serial Number: " .$row->serial_number. "<br /><p>";
                     echo "<p id='id'> ID Number: " .$row->id_number. "<br /><p>";
                     echo "<p id='date'> Date Of Birth: " .$row->date_of_birth. "<br /><p>";
                     echo "<p id='location'> Collect Your I.D at: " .$row->location. "<br /><br /><p>";
	    	} 
            
	    }

	    public function rows(){

	    	$this->total = $this->my_query()->rowCount();

	    	return $this->total;
	    }

	    public function loading(){

            $this->start = microtime(true);
            $y = 0;
                 for($x=0;$x<=1000000;$x++){
                 	 $y = $x;
                 }    
          $this->final = number_format((microtime(true) - $this->start), 2);

          return $this->final;
	    }

}

?>
