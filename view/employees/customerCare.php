<?php
    // if (!isset($_SESSION)) 
    // { 
    //     session_start(); 
    // } 
    // if (!isset($_SESSION['empID'])) {
    //     header("location: ../login/loginView.php");
    // }
    include '../../employees/partials/header.php';
    $receiptps = array(); 
    // include 'partials/loginCheck.php';
?>
<div class="col main-right container-fluid">
<div class="container-fluid mt-5">
		<div class="row chatbox">
			<div class="col-md-4">
				<div class="card mb-3">
					<div class="message-list">
						<div class="card">
							<div class="message ">
								<img src="path/to/avatar-1.png" alt="Avatar">
								<div class="message-content ">
									<p>Đây là tin nhắn của khách hàng 1</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="message">
								<img src="path/to/avatar-2.png" alt="Avatar">
								<div class="message-content">
									<p>Đây là tin nhắn của khách hàng 2</p>
								</div>
							</div>
						</div>
						<!-- Thêm các tin nhắn khác của khách hàng tại đây -->
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-header">Khách hàng 1 </div>
					<div class="card-body chat">
						<div class="chat-message received">
							<img src="https://via.placeholder.com/50" alt="Avatar" class="chat-avatar">
							<div class="message-bubble">
								<p>Chào bạn, tôi có thể giúp gì cho bạn?</p>
							</div>
						</div>
						<div class="chat-message sent">
							<div class="message-bubble">
								<p>Tôi muốn hỏi về sản phẩm này</p>
							</div>
							<img src="https://via.placeholder.com/50" alt="Avatar" class="chat-avatar">
						</div>
						<div class="chat-message received">
							<img src="https://via.placeholder.com/50" alt="Avatar" class="chat-avatar">
							<div class="message-bubble">
								<p>Dạ, sản phẩm này có gì bạn cần tư vấn thêm không?</p>
							</div>
						</div>
						<div class="chat-message sent">
							<div class="message-bubble">
								<p>Tôi cần biết giá sản phẩm</p>
							</div>
							<img src="https://via.placeholder.com/50" alt="Avatar" class="chat-avatar">
						</div>
						<div class="chat-message received">
							<img src="https://via.placeholder.com/50" alt="Avatar" class="chat-avatar">
							<div class="message-bubble">
								<p>Giá sản phẩm hiện tại là 1.000.000 VNĐ</p>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<form>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Nhập tin nhắn...">
								<button type="submit" class="btn btn-primary">Gửi</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

</div>

</div>
<?php
include "../../employees/partials/footer.php";
?>