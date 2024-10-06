@extends('backend.layouts.base')
@section('title', 'Articles | Admin')

@section('content')

<div class="page-content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-lg-9 col-xl-10  d-flex justify-content-lg-start justify-content-center">
							<div class="page-breadcrumb d-flex d-sm-flex align-items-center mb-2">
								<div class="breadcrumb-title pe-3">Articles</div>
								<div class="ps-3">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb mb-0 p-0">
											<li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
											</li>
											<li class="breadcrumb-item"><a href="/admin/articles">Articles</a></li>
											<li class="breadcrumb-item active" aria-current="page">Comments</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body p-4">
			@if (session('success'))
			<div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-white"><i class='bx bxs-check-circle'></i></div>
					<div class="ms-3">
						<h6 class="mb-0 text-white">Success</h6>
						<div class="text-white">{{ session('success') }}</div>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif
			@if (session('loginError'))
			<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-white"><i class='bx bxs-x-circle'></i></div>
					<div class="ms-3">
						<h6 class="mb-0 text-white">Failed!</h6>
						<div class="text-white">{{ session('loginError') }}</div>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif
			
			<div class="table-responsive">
				<table id="example" class="table mb-0 align-middle" style="width:100%">
					<thead class="table-light">
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Article</th>
                            <th>Comment</th>
							<th>Commented at</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($comments as $row)
						<tr>
							<td>{{$loop->iteration}}</td>
                            <td>{{ $row->username }}</td>
							<td>{{ $row->email }}</td>
							<td>
								@if(strlen($row->article->title) > 55)
									{{ substr($row->article->title, 0, 55) }}...
								@else
									{{ $row->article->title }}
								@endif
							</td>
							
                            <td>
								<button
									type="button" class="btn btn-primary btn-sm radius-30 px-4" data-bs-toggle="modal" data-bs-target="#comment-{{ $row->id }}"> See Comment
								</button>		
							</td>
							<td>{{ $row->created_at->format('d M Y, h.iA') }}</td>
							<td>{!! $row->status_label !!}</td>
							<td>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
										@if($row->status == 'DRAFT')
										<li>
											<form action="{{ route('comments.publish', $row->id) }}" method="post">
												@csrf
												@method('PUT')
												<button type="submit" class="dropdown-item" id="publish">Publish</button> 
											</form>
										</li>
										@endif
										<li>
											<form action="{{ route('comments.delete', $row->id) }}" method="post">
												@csrf
												@method('DELETE')
												<button type="submit" class="dropdown-item" id="delete">Delete</button> 
											</form>
										</li>
									</ul>
								</div>
							</td>
							<div class="modal fade" id="comment-{{ $row->id }}" tabindex="-1" aria-hidden="true">
							
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Comments from {{ $row->username }}</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">{{ $row->comment }}</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						@empty
						<tr>
							<td colspan="7" class="text-center">No comment data available in table</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection