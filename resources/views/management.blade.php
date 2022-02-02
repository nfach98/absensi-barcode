@extends('layouts.app')

@section('app')
<main>
	<div>
	    <div class="row">
	        <div class="col-12">
	            <div class="card mb-4 mx-4">
	                <div class="card-header pb-0">
	                    <div class="d-flex flex-row justify-content-between">
	                        <div>
	                            <h5 class="mb-0">Data Absensi</h5>
	                        </div>
	                        <div class="btn bg-gradient-primary btn-sm mb-3" type="date">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y')
	                        }}</div>
	                    </div>
                        
	                </div>
	                <div id="card-absensi" class="card-body px-0 pt-0 pb-2">
	                	@if($masuk->isEmpty() && $pulang->isEmpty())
		                	<div class="d-flex flex-row px-5 py-5 justify-content-center align-items-center">
		                        <div>
		                        	<img src="../assets/img/no_data.png" height="200" alt="No data">
		                            <p class="mb-0 text-center">Tidak ada data absensi</p>
		                        </div>
	                		</div>
	                	@else
	                		@if (!$masuk->isEmpty())
			                	<div class="d-flex flex-row px-5 pt-5 justify-content-center align-items-center">
			                        <h5 class="text-center mb-0">Masuk</h5>
		                		</div>
			                    <div class="table-responsive">
			                        <table class="table align-items-center mb-0">
			                            <thead>
			                                <tr>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Pegawai
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Email
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Jabatan
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        No. Telp
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Shift
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Jam Masuk
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Suhu Badan
			                                    </th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            	@foreach($masuk as $user_masuk)
			                            	<tr>
			                                    <td class="text-center">
			                                    	<div class="d-flex flex-row justify-content-start align-items-center px-2">
			                                            <img src="{{ $user_masuk->foto ? url($user_masuk->foto) : url('assets\img\placeholder_avatar.png') }}" class="avatar avatar-sm me-3">
			                                        	<p class="text-{{ $user_masuk->suhu_badan > 37 || date('H', strtotime($user_masuk->jam_absen)) >= date('H', strtotime($user_masuk->jam_masuk)) && date('i', strtotime($user_masuk->jam_absen)) >= date('i', strtotime($user_masuk->jam_masuk)) ? 'danger' : 'secondary'}} text-xs font-weight-bold mb-0">{{ $user_masuk->name }}</p>
			                                    	</div>
			                                    </td>
			                                    <td class="text-center">
			                                        <p class="text-xs font-weight-bold mb-0">{{ $user_masuk->email }}</p>
			                                    </td>
			                                    <td class="text-center">
			                                        <p class="text-xs font-weight-bold mb-0">{{ $user_masuk->jabatan }}</p>
			                                    </td>
			                                    <td class="text-center">
			                                        <span class="text-secondary text-xs font-weight-bold">{{ $user_masuk->phone }}</span>
			                                    </td>
			                                    <td class="text-center">
			                                        <span class="text-secondary text-xs font-weight-bold">{{ $user_masuk->shift }}</span>
			                                    </td>
			                                     <td class="text-center">
			                                     	<div class="d-flex flex-column justify-content-center align-items-center px-2">
			                                            <span class="text-{{ date('H', strtotime($user_masuk->jam_absen)) >= date('H', strtotime($user_masuk->jam_masuk)) && date('i', strtotime($user_masuk->jam_absen)) >= date('i', strtotime($user_masuk->jam_masuk)) ? 'danger' : 'secondary'}} text-xs font-weight-bold">{{ date('H:i:s', strtotime($user_masuk->jam_absen)) }}</span>
			                                        	@if(date('H', strtotime($user_masuk->jam_absen)) >= date('H', strtotime($user_masuk->jam_masuk)) && date('i', strtotime($user_masuk->jam_absen)) >= date('i', strtotime($user_masuk->jam_masuk)))
			                                        		<span class="text-danger text-xs font-weight-bold">Terlambat</span>
			                                        	@endif
			                                    	</div>
			                                    </td>
			                                     <td class="text-center">
			                                     	<div class="d-flex flex-column justify-content-center align-items-center px-2">
			                                            <span class="text-{{ $user_masuk->suhu_badan > 37 ? 'danger' : 'secondary'}} text-xs font-weight-bold">{{ $user_masuk->suhu_badan }} °C</span>
			                                        	<span class="text-{{ $user_masuk->suhu_badan > 37 ? 'danger' : 'secondary'}} text-xs font-weight-bold">{{ $user_masuk->suhu_badan > 37 ? 'WFH' : 'WFO'}}</span>
			                                    	</div>
			                                    </td>
			                                </tr>
			                            	@endforeach
			                            </tbody>
			                        </table>
			                    </div>
		                    @endif

		                    @if (!$pulang->isEmpty())
			                    <div class="d-flex flex-row px-5 pt-5 justify-content-center align-items-center">
			                        <h5 class="text-center mb-0">Pulang</h5>
		                		</div>
			                    <div class="table-responsive">
			                        <table class="table align-items-center mb-0">
			                            <thead>
			                                <tr>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Pegawai
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Email
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Jabatan
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        No. Telp
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Shift
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Jam Pulang
			                                    </th>
			                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
			                                        Suhu Badan
			                                    </th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            	@foreach($pulang as $user_pulang)
			                            	<tr>
			                                    <td class="text-center">
			                                    	<div class="d-flex flex-row justify-content-start align-items-center px-2">
			                                            <img src="{{ $user_pulang->foto ? url($user_pulang->foto) : url('assets\img\placeholder_avatar.png') }}" class="avatar avatar-sm me-3">
			                                        	<p class="text-{{ $user_pulang->suhu_badan > 37 || date('H', strtotime($user_pulang->jam_absen)) < date('H', strtotime($user_pulang->jam_pulang)) ? 'danger' : 'secondary'}} text-xs font-weight-bold mb-0">{{ $user_pulang->name }}</p>
			                                    	</div>
			                                    </td>
			                                    <td class="text-center">
			                                        <p class="text-xs font-weight-bold mb-0">{{ $user_pulang->email }}</p>
			                                    </td>
			                                    <td class="text-center">
			                                        <p class="text-xs font-weight-bold mb-0">{{ $user_pulang->jabatan }}</p>
			                                    </td>
			                                    <td class="text-center">
			                                        <span class="text-secondary text-xs font-weight-bold">{{ $user_pulang->phone }}</span>
			                                    </td>
			                                    <td class="text-center">
			                                        <span class="text-secondary text-xs font-weight-bold">{{ $user_pulang->shift }}</span>
			                                    </td>
			                                     <td class="text-center">
			                                     	<div class="d-flex flex-column justify-content-center align-items-center px-2">
			                                            <span class="text-{{ date('H', strtotime($user_pulang->jam_absen)) < date('H', strtotime($user_pulang->jam_pulang)) ? 'danger' : 'secondary'}} text-xs font-weight-bold">{{ date('H:i:s', strtotime($user_pulang->jam_absen)) }}</span>
			                                        	@if(date('H', strtotime($user_pulang->jam_absen)) < date('H', strtotime($user_pulang->jam_pulang)))
			                                        		<span class="text-danger text-xs font-weight-bold">Pulang awal</span>
			                                        	@endif
			                                    	</div>
			                                    </td>
			                                     <td class="text-center">
			                                     	<div class="d-flex flex-column justify-content-center align-items-center px-2">
			                                            <span class="text-{{ $user_pulang->suhu_badan > 37 ? 'danger' : 'secondary'}} text-xs font-weight-bold">{{ $user_pulang->suhu_badan }} °C</span>
			                                        	<span class="text-{{ $user_pulang->suhu_badan > 37 ? 'danger' : 'secondary'}} text-xs font-weight-bold">{{ $user_pulang->suhu_badan > 37 ? 'WFH' : 'WFO'}}</span>
			                                    	</div>
			                                    </td>
			                                </tr>
			                            	@endforeach
			                            </tbody>
			                        </table>
			                    </div>
		                    @endif
	                    @endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</main>

<script type="text/javascript">
	window.onload = function () {
		var options = { hour12: false };
		
		setInterval(function() {
		    $.ajax({
		      url: "{{ route('absensi') }}",
		      type: "POST",
		      data: {
		        _token:'{{ csrf_token() }}'
		      },
		      cache: false,
		      dataType: 'json',
		      success: function(data){
		        if(data['masuk'].length <= 0 && data['pulang'].length <= 0)
	            {
	                $("#card-absensi").html("<div class='d-flex flex-row px-5 py-5 justify-content-center align-items-center'>\
                        <div>\
                        	<img src='../assets/img/no_data.png' height='200' alt='No data'>\
                            <p class='mb-0 text-center'>Tidak ada data absensi</p>\
                        </div>\
            		</div>");
	            }
	            else {
	            	var element = "";
	            	if (data['masuk'].length > 0) {
	            		var list = "";

	            		data['masuk'].forEach(function(item, index) {
	            			var jamAbsen = new Date(item.jam_absen);
	            			var jamMasuk = new Date();
	            			jamMasuk.setHours(item.jam_masuk.split(":")[0]);
	            			jamMasuk.setMinutes(item.jam_masuk.split(":")[1]);

	            			var isTerlambat = jamAbsen.getHours() >= jamMasuk.getHours() && jamAbsen.getMinutes() > jamMasuk.getMinutes();
	            			var isWfh = item.suhu_badan > 37;
	            			var url = "{{ url('assets/img/placeholder_avatar.png') }}";
	            			if (item.foto) {
	            				url = "{{ url('/') }}" + "/" + item.foto;
	            			}
	            			
	            			list = list + "<tr>\
                                <td class='text-center'>\
                                	<div class='d-flex flex-row justify-content-start align-items-center px-2'>\
                                        <img src='" + url + "' class='avatar avatar-sm me-3'>\
                                    	<p class='" + (isWfh || isTerlambat ? "text-danger" : "text-secondary") + " text-xs font-weight-bold mb-0'>" + item.name + "</p>\
                                	</div>\
                                </td>\
                                <td class='text-center'>\
                                    <p class='text-xs font-weight-bold mb-0'>" + item.email + "</p>\
                                </td>\
                                <td class='text-center'>\
                                    <p class='text-xs font-weight-bold mb-0'>" + item.jabatan + "</p>\
                                </td>\
                                <td class='text-center'>\
                                    <span class='text-secondary text-xs font-weight-bold'>" + item.phone + "</span>\
                                </td>\
                                <td class='text-center'>\
                                    <span class='text-secondary text-xs font-weight-bold'>" + item.shift + "</span>\
                                </td>\
                                <td class='text-center'>\
                                 	<div class='d-flex flex-column justify-content-center align-items-center px-2'>\
                                        <span class='" + (isTerlambat ? "text-danger" : "text-secondary") + " text-xs font-weight-bold'>" + jamAbsen.toLocaleTimeString('en-US', options).split(" ")[0] + "</span>"
                                        + (isTerlambat ? "<span class='text-danger text-xs font-weight-bold'>Terlambat</span>" : "") +
                                	"</div>\
                                </td>\
                                <td class='text-center'>\
                                 	<div class='d-flex flex-column justify-content-center align-items-center px-2'>\
                                        <span class='" + (isWfh ? "text-danger" : "text-secondary") + " text-xs font-weight-bold'>" + item.suhu_badan + " °C</span>\
                                    	<span class='" + (isWfh ? "text-danger" : "text-secondary") + " text-xs font-weight-bold'>" + (isWfh ? "WFH" : "WFO") + "</span>\
                                	</div>\
                                </td>\
                            </tr>";
	            		});

	            		element = element + "<div class='d-flex flex-row px-5 pt-5 justify-content-center align-items-center'>\
	                        <h5 class='text-center mb-0'>Masuk</h5>\
                		</div>\
	                    <div class='table-responsive'>\
	                        <table class='table align-items-center mb-0'>\
	                            <thead>\
	                                <tr>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Pegawai\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Email\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Jabatan\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        No. Telp\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Shift\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Jam Masuk\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Suhu Badan\
	                                    </th>\
	                                </tr>\
	                            </thead>\
	                            <tbody>" + list + "</tbody>\
	                        </table>\
	                    </div>";
	            	}
	            	if (data['pulang'].length > 0) {
	            		var list = "";

	            		data['pulang'].forEach(function(item, index) {
	            			var jamAbsen = new Date(item.jam_absen);
	            			var jamPulang = new Date(item.jam_pulang);

	            			var isPulangAwal = jamAbsen.getHours() < jamPulang.getHours();
	            			var isWfh = item.suhu_badan > 37;
	            			var url = "{{ url('assets/img/placeholder_avatar.png') }}";
	            			if (item.foto) {
	            				url = "{{ url('/') }}" + "/" + item.foto;
	            			}
	            			
	            			list = list + "<tr>\
                                <td class='text-center'>\
                                	<div class='d-flex flex-row justify-content-start align-items-center px-2'>\
                                        <img src='" + url + "' class='avatar avatar-sm me-3'>\
                                    	<p class='" + (isWfh || isPulangAwal ? "text-danger" : "text-secondary") + " text-xs font-weight-bold mb-0'>" + item.name + "</p>\
                                	</div>\
                                </td>\
                                <td class='text-center'>\
                                    <p class='text-xs font-weight-bold mb-0'>" + item.email + "</p>\
                                </td>\
                                <td class='text-center'>\
                                    <p class='text-xs font-weight-bold mb-0'>" + item.jabatan + "</p>\
                                </td>\
                                <td class='text-center'>\
                                    <span class='text-secondary text-xs font-weight-bold'>" + item.phone + "</span>\
                                </td>\
                                <td class='text-center'>\
                                    <span class='text-secondary text-xs font-weight-bold'>" + item.shift + "</span>\
                                </td>\
                                <td class='text-center'>\
                                 	<div class='d-flex flex-column justify-content-center align-items-center px-2'>\
                                        <span class='" + (isPulangAwal ? "text-danger" : "text-secondary") + " text-xs font-weight-bold'>" + jamAbsen.toLocaleTimeString('en-US', options).split(" ")[0] + "</span>"
                                        + (isPulangAwal ? "<span class='text-danger text-xs font-weight-bold'>Pulang awal</span>" : "") +
                                	"</div>\
                                </td>\
                                <td class='text-center'>\
                                 	<div class='d-flex flex-column justify-content-center align-items-center px-2'>\
                                        <span class='" + (isWfh ? "text-danger" : "text-secondary") + " text-xs font-weight-bold'>" + item.suhu_badan + " °C</span>\
                                    	<span class='" + (isWfh ? "text-danger" : "text-secondary") + " text-xs font-weight-bold'>" + (isWfh ? "WFH" : "WFO") + "</span>\
                                	</div>\
                                </td>\
                            </tr>";
	            		});

	            		element = element + "<div class='d-flex flex-row px-5 pt-5 justify-content-center align-items-center'>\
		                        <h5 class='text-center mb-0'>Pulang</h5>\
                		</div>\
	                    <div class='table-responsive'>\
	                        <table class='table align-items-center mb-0'>\
	                            <thead>\
	                                <tr>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Pegawai\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Email\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Jabatan\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        No. Telp\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Shift\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Jam Masuk\
	                                    </th>\
	                                    <th class='text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7'>\
	                                        Suhu Badan\
	                                    </th>\
	                                </tr>\
	                            </thead>\
	                            <tbody>" + list + "</tbody>\
	                        </table>\
	                    </div>";
	            	}

	            	$("#card-absensi").html(element);
	            }
		      },
		      error: function(XMLHttpRequest, status, error) { 
		        console.log(error);
		      }
		    });
		  }, 
	  	3000);
	};
</script>
@endsection