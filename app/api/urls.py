from django.conf.urls import url, include
from rest_framework.urlpatterns import format_suffix_patterns
from .views import ListUserView, ListGroupView, ListMahasiswaView, ListMataKuliahView
from .views import RetrieveUserView, RetrieveGroupView, RetrieveMahasiswaView, RetrieveMataKuliahView

urlpatterns = {
	url(r'^user/list$', ListUserView.as_view(), name="list user"),
	url(r'^group/list$', ListGroupView.as_view(), name="list group"),
	url(r'^matakuliah/list$', ListMataKuliahView.as_view(), name="list matakuliah"),
	url(r'^mahasiswa/list$', ListMahasiswaView.as_view(), name="list mahasiswa"),
	url(r'^user/detail/(?P<pk>[0-9]+)/$', RetrieveUserView.as_view(), name="retrieve user"),
	url(r'^group/detail/(?P<pk>[0-9]+)/$', RetrieveGroupView.as_view(), name="retrieve group"),
	url(r'^matakuliah/detail/(?P<pk>[0-9]+)/$', RetrieveMataKuliahView.as_view(), name="retrieve mata kuliah"),
	url(r'^mahasiswa/detail/(?P<pk>[0-9]+)/$', RetrieveMahasiswaView.as_view(), name="retrieve mahsiswa"),
}

urlpatterns = format_suffix_patterns(urlpatterns)