<table class="table" style="width: 100%; padding: 0px;border-spacing: 0px; color: #333;">
	<tbody>
		<tr>
			<td><h3 style="color: #fff; text-align: center; background-color: #3a6a43; padding: 20px 0px; margin: 0px;">{{ config('const.app_name') }}</h3></td>
		</tr>
		<tr>
			<td style="padding: 20px;">
				<table class="table" style="max-width: 800px; margin: 0px auto;">
					<tbody>
						<tr>
							<td style="color: #333;">
								<p style="color: #333;">{{ $name }}様</p>
								<p style="color: #333;">いつもをご利用いただきありがとうございます。</p>
								<p style="color: #333;">お客様のアカウントのパスワード変更についてリクエストを承りました。</p>
								<p style="color: #333;">このパスワード変更リクエストが間違いない場合は、次のリンクをクリックしてお持ちの</p>
								<p style="color: #333;">パスワードをリセットしてください：</p>
								<p style="color: #333;text-align: center; padding: 25px 0px;"><a style="padding: 10px 20px;text-decoration: none;color: #fff;border-color: #3a6a43;background-color: #3a6a43; border-radius: 6px;" href="{!! $link !!}">パスワードリセット</a></p>
								<p style="color: #333;">リンクをクリックしても何も起こらない場合には、お手数ですが代わりに、リンクURLの全てをお使いのブラウザへコピー＆ペーストしアクセスください。</p>
								<p style="color: #333;">万一、このリクエストがお客様による物で無い場合には、このメッセージを無視して頂ければパスワードは変更されません。</p>
								<p style="color: #333;">以上、よろしくお願いいたします。</p>
								<p style="color: #333;"><a href="{!! $link !!}" class="txt-link">{!! $link !!}</a></p>
								<br />
							</td>
						</tr>
					</tbody>	
				</table>
		    </td>
		</tr>
		<tr>
			<td style="color: #333; text-align: center; padding: 20px 0px; background-color: #F8F8F8;">&copy; 2020 {{ config('const.app_name') }}. All rights reserved.</td>
		</tr>
	</tbody>
</table>
