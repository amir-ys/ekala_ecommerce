<?php

namespace Modules\Setting\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Setting\Contracts\FaqRepositoryInterface;
use Modules\Setting\Models\Faq;

class FaqRepo extends BaseRepository implements FaqRepositoryInterface
{
    protected string $model = Faq::class;

    public function store(array $data)
    {
        $this->query->create([
            'question' => $data['question'],
            'answer' => $data['answer'],
            'is_published' => $data['is_published'] ?? Faq::STATUS_UNPUBLISHED,
        ]);
    }

    public function update(int $id, array $data)
    {
        $model = $this->findById($id);
        $model->update([
            'question' => $data['question'],
            'answer' => $data['answer'],
            'is_published' => $data['is_published'] ?? Faq::STATUS_UNPUBLISHED,
        ]);
    }

    public function getPublishedFaqs()
    {
        return $this->query->where('is_published' , Faq::STATUS_PUBLISHED)->get();
    }
}
