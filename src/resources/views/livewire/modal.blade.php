<div wire:ignore.self class="modal fade @if($showModal) show @endif" id="contactDetailModal" tabindex="-1" role="dialog" aria-labelledby="contactDetailModalLabel" aria-hidden="true" style="@if($showModal) display: block; @else display: none; @endif">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactDetailModalLabel">詳細</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($contact)
                    <p><strong>お名前:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
                    <p><strong>性別:</strong> {{ $contact->gender == 'male' ? '男性' : ($contact->gender == 'female' ? '女性' : 'その他') }}</p>
                    <p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
                    <p><strong>電話番号:</strong> {{ $contact->tel1 }}-{{ $contact->tel2 }}-{{ $contact->tel3 }}</p>
                    <p><strong>住所:</strong> {{ $contact->address }}</p>
                    <p><strong>建物名:</strong> {{ $contact->building }}</p>
                    <p><strong>お問い合わせの種類:</strong> {{ $categories[$contact->category_id] }}</p>
                    <p><strong>お問い合わせ内容:</strong> {{ $contact->content }}</p>
                    <p><strong>日付:</strong> {{ $contact->created_at->format('Y-m-d') }}</p>
                @endif
            </div>
            <div class="modal-footer">
                @if($contact)
                    <form action="{{ route('admin.destroy', $contact->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">削除</button>
                    </form>
                @endif
                <button class="btn btn-secondary" type="button" data-dismiss="modal" wire:click="closeModal">閉じる</button>
            </div>
        </div>
    </div>
</div>