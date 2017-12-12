from rest_framework import serializers
from .models import MataKuliah, Mahasiswa, NilaiMutu
from django.contrib.auth.models import User, Group

class UserSerializer(serializers.ModelSerializer):
 	"""Serializer to map the model instance into JSON format."""

 	class Meta:
 		"""Meta class to map serializer's fields with the model fields."""
 		model = User
 		fields = ('id', 'username', 'email', 'groups', 'is_active', 'is_superuser', 'last_login', 'date_joined')
 		read_only_fields = ('last_login', 'date_joined')

class GroupSerializer(serializers.ModelSerializer):
 	"""Serializer to map the model instance into JSON format."""

 	class Meta:
 		"""Meta class to map serializer's fields with the model fields."""
 		model = Group
 		fields = ('id', 'name', 'permissions')

class MataKuliahSerializer(serializers.ModelSerializer):
	"""Serializer to map the model instance into JSON format."""

	class Meta:
		"""Meta class to map serializer's fields with the model fields."""
		model = MataKuliah
		fields = ('id', 'nama', 'kode', 'sks', 'date_created', 'date_modified')
		read_only_fields = ('date_created', 'date_modified')

class MahasiswaSerializer(serializers.ModelSerializer):
	"""Serializer to map the model instance into JSON format."""

	class Meta:
		"""Meta class to map serializer's fields with the model fields."""
		model = Mahasiswa
		fields = ('id', 'nama', 'NIM', 'status', 'date_created', 'date_modified')
		read_only_fields = ('date_created', 'date_modified')

class NilaiMutuSerializer(serializers.ModelSerializer):
	"""Serializer to map the model instance into JSON format."""

	class Meta:
		"""Meta class to map serializer's fields with the model fields."""
		model = NilaiMutu
		fields = ('id', 'mahasiswa', 'semester', 'tahun', 'nilai', 'date_created', 'date_modified')
		read_only_fields = ('date_created', 'date_modified')
