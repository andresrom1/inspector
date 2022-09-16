@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Pruebas') }}</div>

                
                <div class="card-body">
                <?php
                    
                    $d=["5","2","C","D","+"];
                    $result = [];
                    $sum=0;
                    

                    for ($i = 0; $i < sizeof($d); $i++){

                        echo "Valor a evaluar: " . $d[$i] . "<br>";
                        
                        if( intval( $d[$i] ) ){

                            echo $d[$i] . " Es número <br>";

                            array_push($result, $d[$i]);

                            echo "Contenido del array Resultado: ";

                            for ( $j = 0; $j < sizeof($result); $j++ ){

                                echo "<strong>" . $result[$j] . " </strong>";
                            }

                            echo "<br>";

                        } else {

                            if( $d[$i] == "+"){

                                echo $d[$i] . " Es un signo + <br>";

                                echo "Contenido del array Resultado: ";

                                for ( $j = 0; $j < sizeof($result); $j++ ){

                                    echo "<strong>" . $result[$j] . " </strong>";
                                }

                                echo "<br>";

                                $result_size = count($result);

                                echo $result[$result_size-1]+$result[$result_size-2] . "<br>";

                                array_push($result,
                                    (
                                        $result[$result_size-1]+$result[$result_size-2]
                                    )
                                );
                            }

                            if( $d[$i] == "C"){
                                
                                echo $d[$i] . " Elimina el ultimo valor de array <br>";

                                $result_size = count($result);

                                echo "Tamanño de Result: " . count($result) . "<br>";
                                echo "El array RESULT contiene: ";
                                for ($j =0; $j < sizeof($result); $j++ ){
                                    echo "<strong>" . $result[$j] ." </strong>";
                                }

                                echo "<br>";

                                //$remove = array_pop($result);
                                
                                //array_push($result, $result[$result_size-1]*-1); 

                            }

                            if ( $d[$i] == "D"){
                                
                                //doble del anterior
                                $result_size = count($result);
                                echo $result_size . "<br>";
                                

                            }
                        }
                    }


                    for ( $i = 0; $i < sizeof($result); $i++){
                        $sum+=$result[$i];
                    }

                    echo "La suma es: ". $sum . "<br>";

                ?>

                --------------------------------------------------------- <br>
                <?php

                $s = "(()(())[{}]";
                $apertura = [ '{' , '[' , '('];
                $clausura = ['}' , ']' , ')'];
                $arr = [];
                $chek = [];
                $ultimo = [];

                $arr = str_split($s,1);

                echo "El string a validar es: " . $s . "<br>";

                for ($i = 0; $i< count($arr); $i++){
                    
                    if($arr[$i]== '{'){ 

                        array_push($chek, '}');
                        
                       

                    }

                    if($arr[$i]== '['){ 

                        array_push($chek, ']');
                        
                       

                    }

                    if($arr[$i]== '('){ 

                        array_push($chek, ')');
                        
                        

                    }

                    if($arr[$i] == '}' || $arr[$i] == ']' || $arr[$i] == ')'){

                        $ultimo  = count($chek)-1;

                        echo "el valor a sacar de chek es: " . $chek[$ultimo] . " => Indice: ULTIMO: " . $ultimo  ."<br>";

                        if ($chek[$ultimo] == $arr[$i]){
                           
                            if(isset($chek[$ultimo])){

                            $removed = array_pop($chek);                            

                            }                           

                        }

                     }
                }  
                echo "Array count() = " . count($chek) . "<br>";

                if (count($chek)==0){

                    echo "La cadena de entrada está <strong>balanceada</strong>";
                
                } else {

                    echo "La cadena de entrada esta <strong>desbalanceada</strong>";

                }
                
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection