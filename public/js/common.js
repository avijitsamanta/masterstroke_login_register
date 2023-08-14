function emailCheck(entry) {
    if ( (/^[a-zA-Z0-9-._+]+(@[a-zA-Z0-9-.]{1,}[a-zA-Z0-9_.-]+\.)+[a-zA-Z]{2,6}$/).exec(entry) == null)
	{
        return false;
    }
    return true;
}



