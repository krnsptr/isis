from django.shortcuts import render
from rest_framework import generics
from .serializers import UserSerializer, GroupSerializer, MataKuliahSerializer, MahasiswaSerializer, NilaiMutuSerializer
from .models import User, Group, MataKuliah, Mahasiswa, NilaiMutu

# List views here.
# User
class ListUserView(generics.ListAPIView):
	"""This class handle the http GET requests for User."""
	queryset = User.objects.all()
	serializer_class = UserSerializer

class ListGroupView(generics.ListAPIView):
	"""This class handle the http GET requests for Group."""
	queryset = Group.objects.all()
	serializer_class = GroupSerializer

# MataKuliah
class ListMataKuliahView(generics.ListAPIView):
	"""This class handle the http GET requests for MataKuliah."""
	queryset = MataKuliah.objects.all()
	serializer_class = MataKuliahSerializer

# Mahasiswa
class ListMahasiswaView(generics.ListAPIView):
	"""This class handle the http GET requests for Mahasiswa."""
	queryset = Mahasiswa.objects.all()
	serializer_class = MahasiswaSerializer

# Retrieve views here.
# User
class RetrieveUserView(generics.RetrieveAPIView):
	"""This class handle the http GET requests for User."""
	queryset = User.objects.all()
	serializer_class = UserSerializer

class RetrieveGroupView(generics.RetrieveAPIView):
	"""This class handle the http GET requests for Group."""
	queryset = Group.objects.all()
	serializer_class = GroupSerializer

# MataKuliah
class RetrieveMataKuliahView(generics.RetrieveAPIView):
	"""This class handle the http GET requests for MataKuliah."""
	queryset = MataKuliah.objects.all()
	serializer_class = MataKuliahSerializer

# Mahasiswa
class RetrieveMahasiswaView(generics.RetrieveAPIView):
	"""This class handle the http GET requests for Mahasiswa."""
	queryset = Mahasiswa.objects.all()
	serializer_class = MahasiswaSerializer