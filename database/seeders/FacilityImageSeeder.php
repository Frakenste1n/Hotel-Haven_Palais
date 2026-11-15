<?php

namespace Database\Seeders;

use App\Models\FacilityImage;
use App\Models\ResortFacility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacilityImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            [
                'facility' => 'Infinity Horizon Cliff Pool',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAydjU7Gnd3PnDdafmmaP_DoWPjPaWO-HeMI5KaUDRRUsyzSmZxNnjA_nYWsk0_6JvCm-uXmMn-y4uy4EF3s8jb-CCW0hyfUJpTIvFgtwC76Xw-kJcVa3zwTfsiqFjPoJOPvX_g2NNFmUZeURa4JJ4PCIMZ9zHbYLl4KOU0PN1wBeoKZA_TxGCYhaooKASax_5Nii4pu4TBG-1EFtq39UNb9iJi3WrI2_Yp11uST2w',
            ],
            [
                'facility' => 'Serenity Spa & Thalassotherapy',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB8MxL-2BiI8WL_J_5A0i_TadqyqaSmQurD4ZVwQAY8c3jvzSu7zHtJ4bq3w-ldS_fK8zC1c2NE7MjytAMAseWQaE0oxmXhb3296qGRxDiw6691038EVPqdcNS6Qi31j5_bP_wNG3hvNiOXi2N6S_u8afOra5G6LshSLjMpXAqzUxSOLXqTod8iSn6Nfgm4f4D_yRnAt5g6GMiS6eAl4vMMMe-0pfbVR3aKRcQWtKY',
            ],
            [
                'facility' => 'Yoga Pavilion & Fitness Sanctuary',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDxuUiLtVANa92zLf6J7aEbKwOKBVc0Jeho1dxnS54SIaeRAtXB2ChuOkdwU5giGlS_Vnpyy-R62DnmfuLPAot1ZrHDy5XxhCjeaiGrH_pK57MeEp4yDua3HlXl8CLaiJsS91hHrWJyYVuziaTTqZXYydeyI7odqPagR_ii2MGAVWvm278osiZis0JRpDzZW-Qe8W9QDGnNqURaD-7P9d_EurU2VRtrNp2fVJ4QssI',
            ],
            [
                'facility' => 'Palais Haute Cuisine & Degustation',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAnxoyfVtVsGCZSkSobRqSKUkZMLLes20KCyk90k4Uv0WT9E4pcze0a2sfG7CzwreKbActHqD-ggPRtpovxCcD6q-1EHi14B1F2kA9aiWuhM_o-iF5DnR1UN5H8h07E9nbfuKqeuieNOBa-m7BNiKWV7N32kLfcewjyqRn8mvvm2XUHitT3WCk3iPMEComR_RW_18Nl_aPKR5g4SBBqo0GAoiNkjBhKl66XjF5dKBc',
            ],
            [
                'facility' => 'Oceanfront Starlight Cabana',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCvhKk1M_HoNkeN6nTBOfh2yyVQiCjtYFI_e3sarWXC3WoyUvPtJltJDbrGNWyhnW9QmdEyHoDfWFacxi1o7YRvoaU5SrB9hbvoX8sutHWUX9ChYZwDbp8R276mrhzWSmKfbbpeU0FQIwVWPYeX05wzu1LjVA6Ewtr8qTG5jEek1BBAWwmcjMbmZvW0llFWQwRQ5xgbn7rz0b0oQIUOWebfClFt0nmV8OZjkVNVxlo',
            ],
            [
                'facility' => 'Horizon Sunset Cocktail Lounge',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDN_wZGPFp1n-AIQybQ731osJvNSvKAnNv4pGVyYi0XLAhcozic0c6Q-4Vxtp5pKqRkp-K2_w3q5mPVjQmqCy9ANpSavsALFYqK2yQulzOTJ-O4l7vEkPA-c4vjmUPKEOQb3i2Awyfa-hWBFJ6TVybFHo9S12MoDV_n6Au737jseB7RZPyWbsMVOyRMoZBsxZNehBm8WJSCjkTpjf4l4Ql3z9YM-dngX1sWjUog2ZI',
            ],
            [
                'facility' => 'Private Open-Air Amphitheatre',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDFy3BNdhMSlsyDbcRf-nuGI7nJ81CLVjq0TuKC6L_8J8b22U4b98Ga5NGFUNwR85OGqeaISfuhCfsEFwO7_HntOLMHqgH-Xy6i7uKCdPQKMiF5i9Rk4ul5YHr2URnnBgygECDVZ5OcYGLYbjX19IGY7xgphBA4NWR7MPi9ZMBC6m77TWZwcgOTObu1rCGTl7zMAzNDXkbw3DvL5EP10NdVwHzyfCsyLcziUq9-7nw',
            ],
            [
                'facility' => 'Private Cove Beach Club & Yacht',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBpb8DXnwd3e9zjSxOTdVRNTmNF6fyBoUtNuCSOJuJZO5A6YTN9hvBjhUnhmnqfXwvvhz1aKWSOh7ckG12B6JchpYQ67rrRRN7bP0fRfq9N-llWKet3bdkkniCSfRVKnMVD8p9KmaXePZsKjfePc9wBJ0UB0zjZCmeeaF83KCZM8jqaCfIfL9Swo51Zoml8kwj4ogZ1YsCtItLAz1XW69yBT2mC4l4UgUlp_KIWvB0',
            ],
            [
                'facility' => 'CinePalais Private Cinema',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDFAagg2yl7j6cVrsaTOYJw30d1SwFx-xZgV8-wHwliGRpUzWlwa4hvyfUAK4UZKYN5Ou73wrQpi2Z1a0AhcMy4qU2l0tSgf6L_Ew5bxUXXocP9SOzMr0Qf8KruxVknbteUpNob05bDWxBGtTcffrGuDvaHwMFsYCE6F4CVgVx-aArVOf-eNqclUTLs9w9weQp8uDKAwIZ7pF7-z6xZut_wPlWgZzcf_vl92RCJkkI',
            ],
            [
                'facility' => 'Private Helipad & Fleet Maybach',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB0PNaRrTJsFC4s4nD4f8EDPdRWFo60mxjj7cwJ2A2z1CmWNXICLC7QznV9lpWLkjjwjdlU3D64V7aHN2rv6Rtr9shpRdzxYb27rbTrbW2Gqc-ZZUknURBR0LfNCfo3dExIbkQSsk3KJol1Gst_Pz9N9Q54YEvKoCt7HhnKkac6TIuYhDIaGBkZVPeTbvTJMnjPyMSDaJ4goorf0VF6tGR41zqnI223qg1L7ts3BSc',
            ],
            [
                'facility' => 'Dedicated Butler & Concierge',
                'url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA10Wgx6pON__GHPVB9rlb2cLUkIVkdN_OMOgnWn6u63qbxD4ArkH8S-ESD549eEStazpBbc_WlP9auWfRG8Kf8mW9RE-yHVFbeutG_mgRl4CIFI0hDUZqU-BdIO8hQoIe8T5T0pz4EPZuF3Qzy42WBOVQPcBDhSxMC6xVhkUc6sl6OyQjlc7BL9tNs4E1Yc0s0LiYRH9rJyIbPJOk077X_6XwZ_OW23B4f7dj1rqo',
            ],
        ];

        foreach ($images as $index => $imageData) {
            $facility = ResortFacility::where(
                'slug',
                Str::slug($imageData['facility'])
            )->firstOrFail();

            FacilityImage::updateOrCreate(
                [
                    'resort_facility_id' => $facility->id,
                    'sort_order' => 1,
                ],
                [
                    'image_path' => $imageData['url'],
                    'caption' => $imageData['facility'],
                    'is_primary' => true,
                ]
            );
        }
    }
}
