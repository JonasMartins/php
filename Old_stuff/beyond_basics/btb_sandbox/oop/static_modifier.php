<?php
// with static methods you can't use $this!
class Student {
  static $total_students=0;

  static public function add_student() {
    Student::$total_students++;
    // Self tambem funciona

  }
  
  static function welcome_students($var="Hello") {
    echo "{$var} students.";
  }
}
  

// **** Forma instanciando: 
// $student = new Student();
// echo $student->total_students;


// **** forma statica
echo Student::$total_students ."<br />";
echo Student::welcome_students() ."<br />";
echo Student::welcome_students("Greetings") ."<br />";
Student::$total_students = 1;
echo Student::$total_students ."<br />";

// static variables are shared throughout the inheritance tree.

  class One {
    static $foo;
  }
  class Two extends One { }
  class Three extends One { }
  
  One::$foo = 1;
  Two::$foo = 2;
  Three::$foo = 3;
  // o que acontece é que o 3 de Three::$foo recebe
  // o ultimo valor, ou seja, como está na ultima linha
  // de execução, o valor de One será 3 e os outros
  // vão mostrar esse valor, uma vez que estendem de One


  echo One::$foo;   // 3
  echo Two::$foo;   // 3
  echo Three::$foo; // 3
?>