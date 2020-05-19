situs = "http://localhost:2020"

table = (kunci, nama_file, id) ->
	"""
	<tr>
		<td>#{nama_file}</td>
		<td>
			<input class="form-control" readonly value="#{situs}/file/#{kunci}_#{nama_file}">
		</td>
		<td>
			<div class="btn btn-danger hapus" data-id="#{id}">Hapus</div>
		</td>
	</tr>
	"""

$.get "/simpan.php", (data) ->
	teks = ""
	for x in data
		teks += table x.kunci, x.nama_file, x.id
	$(".isinya").html teks

kunci = Math.random().toString().replace("0.", "")

flow = new Flow
	target: "/upload.php?kunci=#{kunci}"

flow.assignBrowse $(".browse")

$(".upload").click ->
	flow.upload()

total = 0
bertahap = 0

flow.on "fileAdded", (file, event) ->
	# console.log file, event
	$(".info-file").html "File telah dipilih"
	total = file.size
	bertahap = 0
	$(".progress-upload").css "width", "0"

flow.on "fileSuccess", (file, message) ->
	# console.log file, message
	$(".info-file").html message
	# console.log file.name
	$.get "/simpan.php?kunci=#{kunci}&nama-file=#{file.name}", (data) ->
		teks = ""
		for x in data
			teks += table x.kunci, x.nama_file, x.id
			# console.log teks
		$(".isinya").html teks

flow.on "fileError", (file, message) ->
	# console.log file, message
	$(".info-file").html message

flow.on "fileProgress", (file, chunk) ->
	# console.log file, chunk
	bertahap += file.chunkSize
	$(".progress-upload").css "width", "#{bertahap / total * 100}%"
	# $(".info-file").html "#{Math.floor bertahap / total * 100}%"
	$(".info-file").html "Sedang diupload"
	# console.log bertahap / total

$(document).on "click", ".hapus", ->
	tanya = confirm "Hapus kah?"
	if tanya
		$.get "/hapus.php?id=#{$(@).data "id"}", (data) ->
			teks = ""
			for x in data
				teks += table x.kunci, x.nama_file, x.id
			$(".isinya").html teks