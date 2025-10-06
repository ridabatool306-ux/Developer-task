@extends('admin.layouts.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="row ">
                @foreach ($post as $posts)
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card author-box">
                            <div class="card-body">
                                <div class="author-box-center">
                                    <img alt="image" src="{{ asset('storage/' . $posts->image) }}"
                                        class="rounded-circle author-box-picture">
                                    <div class="clearfix"></div>
                                    <div class="author-box-name">
                                        <a href="#">{{ $posts->user->name }}</a>
                                    </div>
                                    <div class="author-box-job">{{ $posts->user->role }}</div>
                                </div>
                                <div class="text-start">
                                    <div class="author-box-description">
                                        <h4>{{ $posts->title }}</h4>
                                        <p>
                                            {{ $posts->content }}
                                        </p>
                                    </div>
                                    <div class="mb-2 mt-3">
                                        <div class="text-small font-weight-bold">
                                            @foreach ($posts->tags as $tag)
                                                <span class="badge bg-info">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Existing Comments --}}
                                    <h6 class="text-start pt-3">Comments({{ $posts->comments->count() }})</h6>
                                    <div id="comments-{{ $posts->id }}">
                                        @forelse ($posts->comments as $comment)
                                            <div class="border rounded p-1 mb-2">
                                                <strong>{{ $comment->user->name }}</strong>
                                                <span class="text-muted" style="font-size: 12px;">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </span>
                                                <p class="mb-0">{{ $comment->comment }}</p>
                                                <!-- Reply Button as GET Request -->
                                                <a href="{{ route('post.reply', ['post' => $posts->id, 'comment_id' => $comment->id]) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Reply
                                                </a>

                                                @if ($comment->replies->count())
                                                    <div class="ms-4 mt-2">
                                                        @foreach ($comment->replies as $reply)
                                                            <div class="border rounded p-2 mb-2 bg-light">
                                                                <strong>{{ $reply->user->name }}</strong>
                                                                <span class="text-muted" style="font-size: 12px;">
                                                                    {{ $reply->created_at->diffForHumans() }}
                                                                </span>
                                                                <p class="mb-0">{{ $reply->comment }}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <!-- Show Reply Form ONLY if this comment is selected -->
                                                @if (request('comment_id') == $comment->id)
                                                    <form method="POST" action="{{ route('comments.store') }}"
                                                        class="mt-2">
                                                        @csrf
                                                        <input type="hidden" name="post_id"
                                                            value="{{ $comment->post_id }}">
                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                        <input type="text" name="comment"
                                                            class="form-control form-control-sm"
                                                            placeholder="Write your reply...">
                                                        <button class="btn btn-primary btn-sm mt-1"
                                                            type="submit">Send</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @empty
                                            <p class="text-muted">No comments yet.</p>
                                        @endforelse
                                    </div>

                                    {{-- Comment Form --}}
                                    <div class="mt-5">
                                        <form class="comment-form" action="{{ route('comments.store') }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <input type="hidden" name="redirect_to"
                                                    value="{{ url()->current() }}#comments-{{ $posts->id }}">
                                                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                                <input type="text" name="comment" class="form-control"
                                                    placeholder="Write a comment...">
                                                <button class="btn btn-primary" type="submit">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <div class="settingSidebar">
            <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
            </a>
            <div class="settingSidebar-body ps-container ps-theme-default">
                <div class=" fade show active">
                    <div class="setting-panel-header">Setting Panel
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Select Layout</h6>
                        <div class="selectgroup layout-color w-50">
                            <label class="selectgroup-item">
                                <input type="radio" name="value" value="1"
                                    class="selectgroup-input-radio select-layout" checked>
                                <span class="selectgroup-button">Light</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="value" value="2"
                                    class="selectgroup-input-radio select-layout">
                                <span class="selectgroup-button">Dark</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Sidebar Color</h6>
                        <div class="selectgroup selectgroup-pills sidebar-color">
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="1"
                                    class="selectgroup-input select-sidebar">
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="2"
                                    class="selectgroup-input select-sidebar" checked>
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Color Theme</h6>
                        <div class="theme-setting-options">
                            <ul class="choose-theme list-unstyled mb-0">
                                <li title="white" class="active">
                                    <div class="white"></div>
                                </li>
                                <li title="cyan">
                                    <div class="cyan"></div>
                                </li>
                                <li title="black">
                                    <div class="black"></div>
                                </li>
                                <li title="purple">
                                    <div class="purple"></div>
                                </li>
                                <li title="orange">
                                    <div class="orange"></div>
                                </li>
                                <li title="green">
                                    <div class="green"></div>
                                </li>
                                <li title="red">
                                    <div class="red"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <div class="theme-setting-options">
                            <label class="m-b-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    id="mini_sidebar_setting">
                                <span class="custom-switch-indicator"></span>
                                <span class="control-label p-l-10">Mini Sidebar</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <div class="theme-setting-options">
                            <label class="m-b-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    id="sticky_header_setting">
                                <span class="custom-switch-indicator"></span>
                                <span class="control-label p-l-10">Sticky Header</span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                        <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                            <i class="fas fa-undo"></i> Restore Default
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
