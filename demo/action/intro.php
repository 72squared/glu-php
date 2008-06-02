<?
// illustrate how to call a model. not too tricky, eh?
// i could change the input if i wanted, or pass none at all,
// but in this case, i want to just pass along what i have so far.
return $this->dispatch('model/intro', $input);

// EOF