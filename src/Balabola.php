<?php

namespace Ichinya;

class Balabola
	{

	private string $url;
	private ?string $api_key = null;

	/**
	 * @param string $url
	 * @param string|null $api_key
	 */
	public function __construct(string $url = 'https://zeapi.yandex.net/lab/api/yalm/text3', ?string $api_key = null)
		{
		$this->url = $url;
		$this->api_key = $api_key;
		}


	/**
	 * @param string $query запрос
	 * @param TypeIntro $intro тип запроса
	 * @param int $filter всегда 1
	 * @return array параметры ответа, полученный ответ под ключом text
	 */
	public function request(string $query, TypeIntro $intro, int $filter = 1): array
		{
		return $this->send(compact('query', 'intro', 'filter'));
		}

	private function send(array $data = []): array
		{
		$curl = curl_init();

		$headers = ['Content-Type: application/json'];
		if (!empty($this->api_key))
			{
			$headers[] = 'Authorization: Bearer ' . $this->api_key;
			}

		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return @json_decode($response, true) ?? ['error' => 'bad_server'];
		}

	}
