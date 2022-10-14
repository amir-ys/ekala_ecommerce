<?php

namespace Modules\Setting\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Setting\Contracts\FaqRepositoryInterface;
use Modules\Setting\Models\Contact;

class ContactRepo extends BaseRepository implements FaqRepositoryInterface
{
    protected string $model = Contact::class;

    public function store(array $data)
    {
        $this->query->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
    }

    public function getMessage()
    {
        return $this->query->get();
    }

    public function changeReadAt($id)
    {
        $model = $this->query->findOrFail($id);
        if ($model->read_at == null) {
            $model->update([
                'read_at' => now(),
            ]);
        }
    }

}
