@extends('admin.layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">PT Biasa List</h5>
                    </div>
                    <a href="javascript:void(0)" class="btn bg-gradient-dark btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#addPTBiasaModal">+&nbsp; New Entry</a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama PT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Modal Dasar</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Modal Setor</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat PT</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ptBiasaEntries as $entry)
                            <tr>
                                <td class="ps-4"><p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $entry->nama_pt }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $entry->modal_dasar }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $entry->modal_setor }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $entry->alamat_pt }}</p></td>
                                <td class="text-center">
                                    <a href="{{ route('admin.pt-biasa.show', $entry->id) }}" class="mx-1">
                                        <i class="fas fa-eye text-secondary"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="mx-3" data-id="{{ $entry->id }}" data-bs-toggle="modal" data-bs-target="#editPTBiasaModal">
                                        <i class="fas fa-edit text-secondary"></i>
                                    </a>                                                                        
                                    <form action="{{ route('admin.pt-biasa.destroy', $entry->id) }}" method="POST" class="d-inline ">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash text-secondary"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>            
                    <!-- Include Modal Tambah and Modal Edit -->
                    @include('admin.pt-biasa.create') <!-- Modal for Add -->
                    @include('admin.pt-biasa.edit')   <!-- Modal for Edit -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
