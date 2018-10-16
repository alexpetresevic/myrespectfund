<div class="message-modal">
    <div id="message-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="reminder-form" action="{{ route('message.store') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $funeralHome->user->id }}" id="funeral-home" name="parent">
                <input type="hidden" value="{{ auth()->user()->id }}" id="campaign-user" name="user">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Send message to {{ $funeralHome->name }}</h4>
                        <p id="reminder-date"></p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="message-section">
                            <input type="hidden" value="" id="date" name="date">
                            @php
                                $user = auth()->user();
                            @endphp
                            @if(!is_null($user->userConversation))
                                @foreach($user->userConversation->messages as $message)
                                    @if($message->sender_id == $user->id)
                                        <div class="message-box">
                                            <div class="message-me">
                                                <p>{{ $message->message }}</p>
                                                <span>{{ $message->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="message-box">
                                            <div class="message-other">
                                                <p>{{ $message->message }}</p>
                                                <span>{{ $message->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="message-input">
                            <div class="form-group" id="message-block">
                                <div class="reminder-section">
                                    <label for="message">Message</label>
                                    <textarea class="form-control message" rows="4" id="message-content" name="message"
                                              type="text" value=""></textarea>
                                    @if($errors->has('message'))
                                        {{ $errors->first('message') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button-close" id="modal-close"
                                data-dismiss="modal">Cancel
                        </button>
                        <button type="button" id="send-message" class="button-send">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('stack-script')
    @include('_modals._message-modal-js')
@endpush