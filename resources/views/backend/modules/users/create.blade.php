@extends('backend.layouts.base')
@section('title', 'Add Article | Admin')

@section('content')

<div class="page-content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-lg-9 col-xl-10  d-flex justify-content-lg-start justify-content-center">
							<div class="page-breadcrumb d-flex d-sm-flex align-items-center mb-2">
								<div class="breadcrumb-title pe-3">Add Articles</div>
								<div class="ps-3">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb mb-0 p-0">
											<li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
											</li>
											<li class="breadcrumb-item" aria-current="page"><a href="/admin/articles">Articles</a></li>
											<li class="breadcrumb-item active" aria-current="page">Create</li>
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
	<div class="row">
		<div class="col-xl-12 mx-auto">
			<div class="card">
				<div class="card-body p-4">
					<h5 class="mb-4">Create New Article</h5>
					<form class="row g-3" action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="col-md-6">
							<label for="title" class="form-label">Article Title</label>
							<input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ old('title') }}">
							<p class="text-danger">{{ $errors->first('title') }}</p>
						</div>
						<div class="col-md-3">
							<label for="category_id" class="form-label">Category</label>
							<select name="category_id" class="form-select">
								<option selected>Choose...</option>
								@foreach ($category as $row)
								<option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
								@endforeach
							</select>
							<p class="text-danger">{{ $errors->first('category_id') }}</p>
						</div>
						<div class="col-md-3">
							<label for="header_articles" class="form-label">Image</label>
							<input type="file" class="form-control" name="header_articles">
							<p class="text-danger">{{ $errors->first('header_articles') }}</p>
						</div>
						<div class="col-md-12">
							<label for="content" class="form-label">Description</label>
							<textarea class="form-control" name="content" id="content" placeholder="Enter Description" rows="10">{{ old('content') }}</textarea>
							<p class="text-danger">{{ $errors->first('content') }}</p>
						</div>
						<div class="col-md-12">
							<div class="d-flex d-grid align-items-center justify-content-end gap-3">
								<a href="/admin/articles" class="btn btn-secondary px-4" onclick="window.history.back();">Cancel</a>
								<button type="submit" class="btn btn-warning px-4" name="save_action" value="DRAFT">Draft</button>
								<button type="submit" class="btn btn-primary px-4" name="save_action" value="PUBLISH">Publish</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
	<!--end row-->
</div>

@endsection