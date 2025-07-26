@extends('backoffice.layouts.master')

@section('content_body')
    <h1>Danh sách giao dịch nạp tiền</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Mã giao dịch</th>
                <th>User</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $tx)
                <tr>
                    <td>{{ $tx->code }}</td>
                    <td>{{ $tx->user->name ?? '-' }}</td>
                    <td>{{ number_format($tx->amount) }} VNĐ</td>
                    <td>{{ $tx->status }}</td>
                    <td>{{ $tx->created_at->format('d/m/Y H:i') }}</td>
                    <td><a href="{{ route('backoffice.deposit-transactions.show', $tx->id) }}">Chi tiết</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transactions->links() }}
@endsection
