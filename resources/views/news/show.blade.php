@extends('layouts.app')

@section('title', $news->title)
@section('page-title', 'Detail Berita')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('news.index') }}">Berita</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Berita</h3>
        <div class="card-tools">
            @can('update', $news)
            <a href="{{ route('news.edit', $news) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $news->title }}</h2>
                <div class="text-muted mb-3">
                    <span class="mr-3"><i class="fas fa-user"></i> {{ $news->author->name }}</span>
                    <span class="mr-3"><i class="fas fa-calendar-alt"></i> {{ $news->created_at->format('d F Y H:i') }}</span>
                    <span class="mr-3"><i class="fas fa-tag"></i> {{ $news->category->name }}</span>
                    <span class="badge {{ $news->status == 'published' ? 'badge-success' : ($news->status == 'draft' ? 'badge-warning' : 'badge-danger') }}">
                        {{ ucfirst($news->status) }}
                    </span>
                </div>
                
                @if($news->image)
                <div class="mb-4">
                    <img src="{{ asset('images/news/' . $news->image) }}" alt="Gambar Berita" class="img-fluid rounded">
                </div>
                @endif
                
                @if($news->excerpt)
                <div class="lead mb-4">{{ $news->excerpt }}</div>
                @endif
                
                <div class="news-content">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Berita</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Status:</strong>
                                <span class="float-right">
                                    <span class="badge {{ $news->status == 'published' ? 'badge-success' : ($news->status == 'draft' ? 'badge-warning' : 'badge-danger') }}">
                                        {{ ucfirst($news->status) }}
                                    </span>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong>Penulis:</strong>
                                <span class="float-right">{{ $news->author->name }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Editor:</strong>
                                <span class="float-right">{{ $news->editor ? $news->editor->name : '-' }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Tanggal Dibuat:</strong>
                                <span class="float-right">{{ $news->created_at->format('d F Y H:i') }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Terakhir Diupdate:</strong>
                                <span class="float-right">{{ $news->updated_at->format('d F Y H:i') }}</span>
                            </li>
                            @if($news->published_at)
                            <li class="list-group-item">
                                <strong>Tanggal Publish:</strong>
                                <span class="float-right">{{ $news->published_at->format('d F Y H:i') }}</span>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                
                @if((auth()->user()->isEditor() || auth()->user()->isAdmin()) && $news->status == 'draft')
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Persetujuan Berita</h3>
                    </div>
                    <div class="card-body text-center">
                        <form action="{{ route('news.approve', $news) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-block mb-2">
                                <i class="fas fa-check"></i> Setujui
                            </button>
                        </form>
                        <form action="{{ route('news.reject', $news) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-block">
                                <i class="fas fa-times"></i> Tolak
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection