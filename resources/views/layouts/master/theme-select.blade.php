<select class="form-control input-sm" id="schoolTheme{{$school->id}}" name="school_theme">
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

<script>
    (function () {
        var schoolSelectElement = document.querySelector('#schoolTheme{{$school->id}}');
        if (schoolSelectElement) {
            schoolSelectElement.value = "{{$school->theme}}"
        }
    })()
</script>