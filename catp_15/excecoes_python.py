# -*- coding: utf-8 -*-
import math



##################################################
## Formas geométricas
##################################################

class FormaGeometrica:
    
    def __init__(self):
        raise AbstractClassInstatiationException("forma geométrica abstrata não deve ser instanciada")
    
class Circulo(FormaGeometrica):
    
    def __init__(self, raio):
        self.set_raio(raio)
    
    def set_raio(self, raio):
        if (raio <= 0):
            raise CirculoException("raio do círculo deve ser positivo")
        self._raio = raio
        
    def area(self):
        return math.pi * (self._raio**2)
    
    def perimetro(self):
        return 2 * math.pi * self._raio
        
class Triangulo(FormaGeometrica):
    
    def __init__(self, lado_1, lado_2, lado_3):
        self.set_lados(lado_1, lado_2, lado_3)
    
    def set_lados(self, lado_1, lado_2, lado_3):
        if (lado_1 <= 0 or lado_2 <= 0 or lado_3 <= 0):
            raise TrianguloException("lados do triângulo devem ser positivos")
        if (lado_1 >= lado_2 + lado_3 or
            lado_2 >= lado_3 + lado_1 or
            lado_3 >= lado_1 + lado_2):
            raise TrianguloException("lados inválidos para triangulo")
        
        self._lado_1 = lado_1
        self._lado_2 = lado_2
        self._lado_3 = lado_3
    
    def area(self):
        # Heron's formula
        s = self.perimetro() / 2.0
        return math.sqrt(s * (s - self._lado_1) * (s - self._lado_2) * (s - self._lado_3))
    
    def perimetro(self):
        return (self._lado_1 + self._lado_2 + self._lado_3)
    
class Losango(FormaGeometrica):

    def __init__(self, diagonal_1, diagonal_2):
        self.set_diagonais(diagonal_1, diagonal_2)
    
    def set_diagonais(self, diagonal_1, diagonal_2):
        if (diagonal_1 <= 0 or diagonal_2 <= 0):
            raise LosangoException("diagonais do losango devem ser positivas")
        
        self._diagonal_1 = diagonal_1
        self._diagonal_2 = diagonal_2
        
    def area(self):
        return (self._diagonal_1 * self._diagonal_2) / 2.0
    
    def perimetro(self):
        return 4 * math.sqrt( (self._diagonal_1 / 2.0)**2 + (self._diagonal_2 / 2)**2.0)
    


##################################################
## Exceções
##################################################

class AbstractClassInstatiationException(Exception):
    def __init__(self,msg):
        super(AbstractClassInstatiationException,self).__init__(msg)
        
class FormaGeometricaException(ValueError):
    def __init__(self,msg):
        super(FormaGeometricaException,self).__init__(msg)
        
class CirculoException(FormaGeometricaException):
    def __init__(self,msg):
        super(CirculoException,self).__init__(msg)
        
class TrianguloException(FormaGeometricaException):
    def __init__(self,msg):
        super(TrianguloException,self).__init__(msg)
        
class LosangoException(FormaGeometricaException):
    def __init__(self,msg):
        super(LosangoException,self).__init__(msg)



##################################################
## Main
##################################################

circulo = Circulo(1)
triangulo = Triangulo(3, 4, 5)
losango = Losango(1, 2)

print "círculo, triângulo e losango criados com sucesso"

print "área do círculo:" + str(circulo.area())
print "área do triângulo:" + str(triangulo.area())
print "área do losango:" + str(losango.area())

print "perímetro do círculo:" + str(circulo.perimetro())
print "perímetro do triângulo:" + str(triangulo.perimetro())
print "perímetro do losango:" + str(losango.perimetro())

print "exceções:"

try:
    FormaGeometrica()
except AbstractClassInstatiationException, e:
    print e

try:
    Circulo(-1)
except CirculoException, e:
    print e

try:
    Triangulo(1, 2, 10)
except TrianguloException, e:
    print e

try:
    Triangulo(1, 2, -3)
except TrianguloException, e:
    print e

try:
    Losango(1, -2)
except LosangoException, e:
    print e