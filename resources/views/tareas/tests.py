from django.test import TestCase
from django.urls import reverse
from .models import Publicacion

# Create your tests here.
class PruebasPublicaciones(TestCase):
    @classmethod #para definir que el metodo que tenemos enseguida es metodo de clase
    def setUpTestData(cls):
        cls.pub = Publicacion.objects.create(texto='¡Esto es una prueba!')

    def setUp(self):
        self.respuesta = self.client.get(reverse('inicio'))

    def test_contenido_modelo(self):
        self.assertEqual(self.pub.texto, '¡Esto es una prueba!')

    #def test_url_existe_en_ubicacion_correcta(self):
     #   self.assertEqual(self.respuesta.status_code, 200)

    #def test_nombre_correcto_plantilla(self):
     #   self.assertTemplateUsed(self.respuesta, 'inicio.html')
        
    #def test_contenido_plantilla(self):
     #   self.assertContains(self.respuesta, '¡Esto es una prueba!')
        
    def test_pagina_inicio(self):
        self.assertEqual(self.respuesta.status_code, 200)
        self.assertTemplateUsed(self.respuesta, 'inicio.html')
        self.assertContains(self.respuesta, 'Esto es una prueba!')