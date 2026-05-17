public $category = 'all';

public function render()
{
    $query = Moment::query();
    if ($this->category !== 'all') {
        $query->where('category', $this->category);
    }
    
    return view('livewire.moment-gallery', [
        'moments' => $query->orderBy('event_date', 'desc')->get()
    ]);
}