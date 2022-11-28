@extends('employees.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-5" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive col-lg-8">
        <a href="/employees/create" class="btn btn-primary mb-3"><span data-feather="plus-circle"></span>Tambah</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col" class=" text-center">#</th>
                    <th scope="col">Jenis Karyawan</th>
                    <th scope="col">NRK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Foto</th>
                    <th scope="col" class=" text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td class=" text-center">{{ $loop->iteration }}</td>
                        <td>{{ $employee->jenis_karyawan }}</td>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->nama }}</td>
                        <td>{{ $employee->jenis_kelamin }}</td>

                        @php
                            $dates = $employee->tanggal_lahir;
                            $date=date_create($dates);
                            $date=date_format($date,"j M Y");
                        @endphp

                        <td>{{ $date }}</td>
                        <td>
                            {{-- Modal Action --}}
                            <a data-bs-toggle="modal" data-bs-target="#sendmessage-{{ $employee->id }}">
                                <img class="img-thumbnail img-fluid rounded mx-auto d-block" src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->nama }}">
                            </a>
                            {{-- Modal Content --}}
                            <div class="modal fade" id="sendmessage-{{ $employee->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Foto: {{ $employee->nama }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="img-fluid" src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->nama }}">
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-primary" href="{{ asset('storage/' . $employee->image) }}" target="blank">Lihat Gambar</a>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class=" text-center">
                            <a href="/employees/{{ $employee->id }}/edit" class="badge bg-warning text-decoration-none mx-1 my-1" title="Edit">Ubah</a>

                            <!-- Button trigger modal -->
                            <a type="button" class="badge bg-danger text-decoration-none mx-1 my-1" data-bs-toggle="modal" data-bs-target="#senddelete-{{ $employee->id }}">
                                Hapus
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="senddelete-{{ $employee->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan! Anda akan menghapus:</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Karyawan: {{ $employee->nama }}
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/employees/{{ $employee->id }}" method="POST" class=" d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" title="Delete">Ya</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection