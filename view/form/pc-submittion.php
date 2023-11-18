<form method="POST" enctype="multipart/form-data">
    <p>
        <label for="pc_state">State</label>
        <input type="text" name="pc_state" id="pc_state">
    </p>
    <p>
        <label for="pc_city">City</label>
        <input type="text" name="pc_city" id="pc_city">
    </p>
    <p>
        <label for="pc_country">Country</label>
        <input type="text" name="pc_country" id="pc_country">
    </p>
    <p>
        <label for="pc_audio">Upload a Audio</label>
        <input type="file" name="pc_audio" id="pc_audio" accept="audio/*">
    </p>
    <p>
        <label for="pc_video">Upload a Video</label>
        <input type="file" name="pc_video" id="pc_video" accept="video/*">
    </p>
    <p>
        <label for="pc_doc">Uploda a Document</label>
        <input type="file" id="pc_doc" name="pc_doc" accept=".pdf,.doc,.docx">
    </p>
    <p>
        <button type="submit" name="pc_submittion">Submit</button>
    </p>
</form>