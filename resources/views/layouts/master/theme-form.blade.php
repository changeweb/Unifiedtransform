<form action="{{url('school/theme')}}" class="form-inline" method="post">
  {{csrf_field()}}
  <input type="hidden" name="s" value="{{$school->id}}">
  <div class="form-group">
      <select class="form-control input-sm" id="schoolTheme{{$school->id}}" name="school_theme">
        <option value="{{$school->theme}}" selected>{{$school->theme}}</option>
        <option value="cosmo">cosmo</option>
        <option value="cyborg">cyborg</option>
        <option value="darkly">darkly</option>
        <option value="flatly">flatly</option>
        <option value="journal">journal</option>
        <option value="lumen">lumen</option>
        <option value="paper">paper</option>
        <option value="readable">readable</option>
        <option value="sandstone">sandstone</option>
        <option value="slate">slate</option>
        <option value="simplex">simplex</option>
        <option value="solar">solar</option>
        <option value="spacelab">spacelab</option>
        <option value="superhero">superhero</option>
        <option value="united">united</option>
        <option value="yeti">yeti</option>
      </select>
      <button type="submit" class="btn btn-success btn-sm">Submit</button>
  </div>
</form>
