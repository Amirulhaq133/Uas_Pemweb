@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Dashboard Admin</h2>
        
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Berita</h5>
                        <h3>{{ $stats['total_news'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Berita Published</h5>
                        <h3>{{ $stats['published_news'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>Draft</h5>
                        <h3>{{ $stats['draft_news'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Total User</h5>
                        <h3>{{ $stats['total_users'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent News -->
        <div class="card">
            <div class="card-header">
                <h4>Berita Terbaru</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Penulis</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_news as $news)
                            <tr>
                                <td>{{ Str::limit($news->title, 50) }}</td>
                                <td>{{ $news->category->name }}</td>
                                <td>
                                    @if($news->status == 'published')
                                        <span class="badge bg-success">Published</span>
                                    @elseif($news->status == 'draft')
                                        <span class="badge bg-warning">Draft</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $news->author->name }}</td>
                                <td>{{ $news->created_at->format('d/m/Y H:i') }}</td>
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