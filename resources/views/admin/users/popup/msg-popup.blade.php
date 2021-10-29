<form id="send-msg-customer">
    <input type="hidden" name="sender_id" value="0" />
    <input type="hidden" name="admin_id" value="0" />
    <input type="hidden" name="customer_id" value="{{$record->id}}" />
    <input type="hidden" name="request_id" value="{{$record->id}}" />
    <div class="form-group">
        <label for="exampleInputEmail1">Subject</label>
        <input type="text" class="form-control" name="subject" value="{{old('subject',@$input['subject'])}}" placeholder="Subject">
        <?php if ($errors->has('subject')) { ?>
            <div class="error-message error">
                <?= $errors->first('subject') ?>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Message</label>
        <textarea class="form-control" name="message" rows="3">{{old('message',@$input['message'])}}</textarea>
        <?php if ($errors->has('message')) { ?>
            <div class="error-message error">
                <?= $errors->first('message') ?>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>