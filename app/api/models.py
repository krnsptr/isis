from django.db import models
from django.contrib.auth.models import User, Group
from rest_framework.authtoken.models import Token

# Create your models here.
class MataKuliah(models.Model):
	"""This class represent nilai akhir model"""
	nama = models.CharField(max_length=255, blank=False)
	kode = models.CharField(max_length=6, blank=False, unique=True)
	sks = models.PositiveSmallIntegerField()
	date_created = models.DateTimeField(auto_now_add=True)
	date_modified = models.DateTimeField(auto_now=True)

	def __str__(self):
		"""Return a human readable representation of the model instance."""
		return "{}".format(self.name)

class Mahasiswa(models.Model):
	"""This class represent mahasiswa model"""
	nama = models.CharField(max_length=255, blank=False)
	NIM = models.CharField(max_length=9, blank=False, unique=True)
	angkatan = models.PositiveSmallIntegerField()
	status = models.BooleanField()
	date_created = models.DateTimeField(auto_now_add=True)
	date_modified = models.DateTimeField(auto_now=True)

	def __str__(self):
		"""Return a human readable representation of the model instance."""
		return "{}".format(self.name)

class NilaiMutu(models.Model):
	"""This class represent nilai mutu model"""
	mahasiswa = models.ForeignKey('Mahasiswa', on_delete=models.CASCADE)
	semester = models.BooleanField()
	tahun = models.PositiveIntegerField()
	nilai_choices = (
		('A', 'A'),
		('AB', 'AB'),
		('B', 'B'),
		('BC', 'BC'),
		('C', 'C'),
		('D', 'D'),
		('E', 'E')
	)
	nilai = models.CharField(max_length = 2,choices = nilai_choices)
	date_created = models.DateTimeField(auto_now_add=True)
	date_modified = models.DateTimeField(auto_now=True)

	def __str__(self):
		"""Return a human readable representation of the model instance."""
		return "{}".format(self.name)