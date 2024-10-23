@extends('admin.layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Firma List</h5>
                    </div>
                    <a href="{{ route('firma.create') }}" class="btn bg-gradient-dark btn-sm mb-0" type="button">+&nbsp; New Entry</a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">Nama Firma</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">Modal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">Nomor Telepon Kantor</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">Alamat Firma</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ptFirmaEntries as $entry)
                            <tr>
                                <td class="ps-4"><p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $entry->nama_firma }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $entry->modal }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $entry->no_telp_kantor }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $entry->alamat_firma }}</p></td>
                                <td class="text-center">
                                    <a href="{{ route('firma.show', $entry->id) }}" class="mx-3">
                                        <i class="fas fa-eye text-secondary"></i>
                                    </a>
                                    <a href="{{ route('firma.edit', $entry->id) }}" class="mx-3">
                                        <i class="fas fa-edit text-secondary"></i>
                                    </a>
                                    <form action="{{ route('firma.destroy', $entry->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0" onclick="return confirm('Apakah anda yakin ?')">
                                            <i class="fas fa-trash text-secondary"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
