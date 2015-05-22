<?php //>

//////////////////////////////////////////////////
// Formas geométricas
//////////////////////////////////////////////////

abstract class FormaGeometrica {}

class Circulo extends FormaGeometrica {
    
    private $raio;
    
    public function __construct($raio) {
        $this->set_raio($raio);
    }
    
    public function set_raio($raio) {
        if ($raio <= 0) {
            throw new CirculoException("raio do círculo deve ser positivo");
        }
        
        $this->raio = $raio;
    }
    
    public function area() {
        return pi() * ($this->raio * $this->raio);
    }
    
    public function perimetro() {
        return 2 * pi() * $this->raio;
    }
}


class Triangulo extends FormaGeometrica {
    private $l1, $l2, $l3;
    
    public function __construct($l1, $l2, $l3) {
        $this->set_lados($l1, $l2, $l3);
    }
    
    public function set_lados($l1, $l2, $l3) {
        if ($l1 <= 0 or $l2 <= 0 or $l3 <= 0)
            throw new TrianguloException("lados do triângulo devem ser positivos");
        
        if ($l1 >= $l2 + $l3 or
            $l2 >= $l3 + $l1 or
            $l3 >= $l1 + $l2)
            throw new TrianguloException("lados inválidos para triangulo");
        
        $this->l1 = $l1;
        $this->l2 = $l2;
        $this->l3 = $l3;
    }
    
    public function area() {
        // Heron's formula
        $s = $this->perimetro() / 2.0;
        return sqrt($s * ($s - $this->l1) * ($s - $this->l2) * ($s - $this->l3));
    }
    
    public function perimetro() {
        return ($this->l1 + $this->l2 + $this->l3);
    }
}

class Losango extends FormaGeometrica {
    
    private $d1, $d2;
    
    public function __construct($diagonal_1, $diagonal_2) {
        $this->set_diagonais($diagonal_1, $diagonal_2);
    }
    
    public function set_diagonais($d1, $d2) {
        if ($d1 <= 0 or $d2 <= 0)
            throw new LosangoException("diagonais do losango devem ser positivas");
        
        $this->d1 = $d1;
        $this->d2 = $d2;
    }
    
    public function area() {
        return ($this->d1 * $this->d2) / 2.0;
    }
    
    public function perimetro() {
        return 4 * sqrt( ($this->d1 / 2.0)**2 + ($this->d2 / 2.0)**2);
    }
}



//////////////////////////////////////////////////
// Exceções
//////////////////////////////////////////////////

class FormaGeometricaException extends Exception {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

class CirculoException extends FormaGeometricaException {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

class TrianguloException extends FormaGeometricaException {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

class LosangoException extends FormaGeometricaException {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}



//////////////////////////////////////////////////
// Main
//////////////////////////////////////////////////

$circulo = new Circulo(1);
$triangulo = new Triangulo(3, 4, 5);
$losango = new Losango(1, 2);

print "círculo, triângulo e losango criados com sucesso\n";

print "área do círculo: {$circulo->area()}\n";
print "área do triângulo: {$triangulo->area()}\n";
print "área do losango: {$losango->area()}\n";

print "perímetro do círculo: {$circulo->perimetro()}\n";
print "perímetro do triângulo: {$triangulo->perimetro()}\n";
print "perímetro do losango: {$losango->perimetro()}\n";

print "exceções:\n";

try { 
    $a = new Circulo(-1);
} catch(CirculoException $e) {
    echo "exception: {$e->getMessage()}\n";
}

try {
    $a = new Triangulo(1, 2, 10);
} catch(TrianguloException $e) {
    echo "exception: {$e->getMessage()}\n";
}

try {
    $a = new Triangulo(1, 2, -3);
} catch(TrianguloException $e) {
    echo "exception: {$e->getMessage()}\n";
}

try {
    $a = new Losango(1, -2);
} catch(LosangoException $e) {
    echo "exception: {$e->getMessage()}\n";
}
