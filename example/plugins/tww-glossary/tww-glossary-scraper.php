<?php

// This is an example of the HTML that I need to scrape. I need to get each link value and put it as a post title.

// <div id="az-slider">
// 	<div id="inner-slider">
// 									<div class="letter-section" id="letter-A">
// 					<h2>
// 						<span>A</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="aborted-human-fetal-dna-ingredient/">Aborted Human Fetal DNA</a>
// 							</li>
// 													<li>
// 								<a href="abortion/">Abortion</a>
// 							</li>
// 													<li>
// 								<a href="acute-flaccid-paralysis/">Acute Flaccid Paralysis</a>
// 							</li>
// 													<li>
// 								<a href="adem/">ADEM</a>
// 							</li>
// 													<li>
// 								<a href="allergies/">Allergies</a>
// 							</li>
// 													<li>
// 								<a href="als/">ALS</a>
// 							</li>
// 													<li>
// 								<a href="aluminum/">Aluminum/Aluminium</a>
// 							</li>
// 													<li>
// 								<a href="alzheimers/">Alzheimer’s</a>
// 							</li>
// 													<li>
// 								<a href="anaphylaxis/">Anaphylaxis</a>
// 							</li>
// 													<li>
// 								<a href="anemia/">Anemia</a>
// 							</li>
// 													<li>
// 								<a href="animals/">Animals</a>
// 							</li>
// 													<li>
// 								<a href="anthrax/">Anthrax</a>
// 							</li>
// 													<li>
// 								<a href="arthritis/">Arthritis</a>
// 							</li>
// 													<li>
// 								<a href="asia/">ASIA</a>
// 							</li>
// 													<li>
// 								<a href="asthma/">Asthma</a>
// 							</li>
// 													<li>
// 								<a href="attention-deficit-disorder/">Attention Deficit Disorder</a>
// 							</li>
// 													<li>
// 								<a href="autism/">Autism</a>
// 							</li>
// 													<li>
// 								<a href="autoimmunity/">Autoimmunity</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-B">
// 					<h2>
// 						<span>B</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="bcg/">BCG</a>
// 							</li>
// 													<li>
// 								<a href="bells-palsy/">Bell’s Palsy</a>
// 							</li>
// 													<li>
// 								<a href="breastfeeding/">Breastfeeding</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-C">
// 					<h2>
// 						<span>C</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="cancer/">Cancer</a>
// 							</li>
// 													<li>
// 								<a href="cardiorespiratory/">Cardiorespiratory</a>
// 							</li>
// 													<li>
// 								<a href="cardiovascular/">Cardiovascular</a>
// 							</li>
// 													<li>
// 								<a href="cdc/">CDC</a>
// 							</li>
// 													<li>
// 								<a href="chickenpox/">Chickenpox</a>
// 							</li>
// 													<li>
// 								<a href="cholera/">Cholera</a>
// 							</li>
// 													<li>
// 								<a href="chronic-fatigue-syndrome/">Chronic Fatigue Syndrome</a>
// 							</li>
// 													<li>
// 								<a href="contamination/">Contamination</a>
// 							</li>
// 													<li>
// 								<a href="corruption/">Corruption</a>
// 							</li>
// 													<li>
// 								<a href="crps/">CRPS</a>
// 							</li>
// 													<li>
// 								<a href="cutter/">Cutter Incident</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-D">
// 					<h2>
// 						<span>D</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="death/">Death</a>
// 							</li>
// 													<li>
// 								<a href="dermatological/">Dermatological</a>
// 							</li>
// 													<li>
// 								<a href="diabetes/">Diabetes</a>
// 							</li>
// 													<li>
// 								<a href="dtap/">DTaP</a>
// 							</li>
// 													<li>
// 								<a href="dtp/">DTP</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-E">
// 					<h2>
// 						<span>E</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="eczema/">Eczema</a>
// 							</li>
// 													<li>
// 								<a href="encephalitis/">Encephalitis</a>
// 							</li>
// 													<li>
// 								<a href="encephalomyelitis/">Encephalomyelitis</a>
// 							</li>
// 													<li>
// 								<a href="encephalopathy/">Encephalopathy</a>
// 							</li>
// 													<li>
// 								<a href="error/">Error</a>
// 							</li>
// 													<li>
// 								<a href="eyes/">Eyes</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-F">
// 					<h2>
// 						<span>F</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="failure/">Failure</a>
// 							</li>
// 													<li>
// 								<a href="featured-studies/">Featured Studies 🛑</a>
// 							</li>
// 													<li>
// 								<a href="fetal-death/">Fetal Death</a>
// 							</li>
// 													<li>
// 								<a href="fibromyalgia/">Fibromyalgia</a>
// 							</li>
// 													<li>
// 								<a href="financial/">Financial Incentives</a>
// 							</li>
// 													<li>
// 								<a href="flu/">Flu</a>
// 							</li>
// 													<li>
// 								<a href="food-allergies/">Food Allergies</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-G">
// 					<h2>
// 						<span>G</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="gardasil/">Gardasil</a>
// 							</li>
// 													<li>
// 								<a href="gastrointestinal/">Gastrointestinal</a>
// 							</li>
// 													<li>
// 								<a href="guillain-barre/">Guillain-Barre</a>
// 							</li>
// 													<li>
// 								<a href="gulf-war-syndrome/">Gulf War Syndrome</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-H">
// 					<h2>
// 						<span>H</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="h1n1/">H1N1</a>
// 							</li>
// 													<li>
// 								<a href="hair-loss/">Hair Loss</a>
// 							</li>
// 													<li>
// 								<a href="hashimotos/">Hashimoto’s</a>
// 							</li>
// 													<li>
// 								<a href="hearing-loss/">Hearing Loss</a>
// 							</li>
// 													<li>
// 								<a href="hepatitis/">Hepatitis</a>
// 							</li>
// 													<li>
// 								<a href="hepatitis-a/">Hepatitis A</a>
// 							</li>
// 													<li>
// 								<a href="hepatitis-b/">Hepatitis B</a>
// 							</li>
// 													<li>
// 								<a href="hexavalent/">Hexavalent</a>
// 							</li>
// 													<li>
// 								<a href="hib/">Hib</a>
// 							</li>
// 													<li>
// 								<a href="hla/">HLA</a>
// 							</li>
// 													<li>
// 								<a href="2670-2/">HPV</a>
// 							</li>
// 													<li>
// 								<a href="hypotonic-hyporesponsive-episodes/">Hypotonic-Hyporesponsive Episodes</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-I">
// 					<h2>
// 						<span>I</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="immune/">Immune System</a>
// 							</li>
// 													<li>
// 								<a href="influenza/">Influenza</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-J">
// 					<h2>
// 						<span>J</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="japanese-encephalitis/">Japanese Encephalitis</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-K">
// 					<h2>
// 						<span>K</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="k/">K</a>
// 							</li>
// 													<li>
// 								<a href="kawasaki/">Kawasaki</a>
// 							</li>
// 													<li>
// 								<a href="kidney/">Kidney</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-L">
// 					<h2>
// 						<span>L</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="leprosy/">Leprosy</a>
// 							</li>
// 													<li>
// 								<a href="liver/">Liver</a>
// 							</li>
// 													<li>
// 								<a href="lung/">Lung</a>
// 							</li>
// 													<li>
// 								<a href="lupus/">Lupus</a>
// 							</li>
// 													<li>
// 								<a href="lyme/">Lyme</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-M">
// 					<h2>
// 						<span>M</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="macrophagic-myofasciitis/">Macrophagic Myofasciitis</a>
// 							</li>
// 													<li>
// 								<a href="measles/">Measles</a>
// 							</li>
// 													<li>
// 								<a href="meningitis/">Meningitis</a>
// 							</li>
// 													<li>
// 								<a href="meningococcal/">Meningococcal</a>
// 							</li>
// 													<li>
// 								<a href="mercury/">Mercury</a>
// 							</li>
// 													<li>
// 								<a href="miscellaneous/">Miscellaneous</a>
// 							</li>
// 													<li>
// 								<a href="mitochondria/">Mitochondria</a>
// 							</li>
// 													<li>
// 								<a href="mmr/">MMR</a>
// 							</li>
// 													<li>
// 								<a href="mmrv/">MMRV</a>
// 							</li>
// 													<li>
// 								<a href="molecular-mimicry/">Molecular Mimicry</a>
// 							</li>
// 													<li>
// 								<a href="multiple-sclerosis/">Multiple Sclerosis</a>
// 							</li>
// 													<li>
// 								<a href="mumps/">Mumps</a>
// 							</li>
// 													<li>
// 								<a href="musculoskeletal/">Musculoskeletal</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-N">
// 					<h2>
// 						<span>N</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="narcolepsy/">Narcolepsy</a>
// 							</li>
// 													<li>
// 								<a href="neurodevelopmental/">Neurodevelopmental</a>
// 							</li>
// 													<li>
// 								<a href="neurological/">Neurological</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-O">
// 					<h2>
// 						<span>O</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="ophthalmological/">Ophthalmological</a>
// 							</li>
// 													<li>
// 								<a href="ovarian/">Ovarian</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-P">
// 					<h2>
// 						<span>P</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="pancreatitis/">Pancreatitis</a>
// 							</li>
// 													<li>
// 								<a href="paralysis/">Paralysis</a>
// 							</li>
// 													<li>
// 								<a href="parkinsonism/">Parkinsonism</a>
// 							</li>
// 													<li>
// 								<a href="parvo/">Parvo</a>
// 							</li>
// 													<li>
// 								<a href="peanut/">Peanut</a>
// 							</li>
// 													<li>
// 								<a href="pertussis/">Pertussis</a>
// 							</li>
// 													<li>
// 								<a href="pneumococcal/">Pneumococcal</a>
// 							</li>
// 													<li>
// 								<a href="pneumonia/">Pneumonia</a>
// 							</li>
// 													<li>
// 								<a href="polio/">Polio</a>
// 							</li>
// 													<li>
// 								<a href="pots/">POTS</a>
// 							</li>
// 													<li>
// 								<a href="pregnancy/">Pregnancy</a>
// 							</li>
// 													<li>
// 								<a href="premature/">Premature Infants</a>
// 							</li>
// 													<li>
// 								<a href="psychiatric/">Psychiatric</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 																	<div class="letter-section" id="letter-R">
// 					<h2>
// 						<span>R</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="rabies/">Rabies</a>
// 							</li>
// 													<li>
// 								<a href="recently-vaccinated-shedding-and-injuring-others/">Recently Vaccinated Shedding and Injuring Others</a>
// 							</li>
// 													<li>
// 								<a href="respiratory/">Respiratory</a>
// 							</li>
// 													<li>
// 								<a href="rhogam/">Rhogam</a>
// 							</li>
// 													<li>
// 								<a href="rotavirus/">Rotavirus</a>
// 							</li>
// 													<li>
// 								<a href="rubella/">Rubella</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-S">
// 					<h2>
// 						<span>S</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="seizures/">Seizures</a>
// 							</li>
// 													<li>
// 								<a href="sexual-and-genital-transmission-of-vaccinia/">Sexual Transmission of Vaccinia</a>
// 							</li>
// 													<li>
// 								<a href="shaken-baby-syndrome/">Shaken Baby Syndrome</a>
// 							</li>
// 													<li>
// 								<a href="shedding/">Shedding</a>
// 							</li>
// 													<li>
// 								<a href="shingles/">Shingles</a>
// 							</li>
// 													<li>
// 								<a href="sirva-shoulder-injury/">SIRVA (Shoulder Injury)</a>
// 							</li>
// 													<li>
// 								<a href="sjogrens/">Sjogren’s</a>
// 							</li>
// 													<li>
// 								<a href="small-fiber-neuropathy/">Small Fiber Neuropathy</a>
// 							</li>
// 													<li>
// 								<a href="smallpox/">Smallpox</a>
// 							</li>
// 													<li>
// 								<a href="stroke/">Stroke</a>
// 							</li>
// 													<li>
// 								<a href="sudden-infant-death-syndrome/">Sudden Infant Death Syndrome</a>
// 							</li>
// 													<li>
// 								<a href="sv40-simian-virus/">SV40 Simian Virus</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-T">
// 					<h2>
// 						<span>T</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="tdap/">Tdap</a>
// 							</li>
// 													<li>
// 								<a href="tetanus/">Tetanus</a>
// 							</li>
// 													<li>
// 								<a href="thimerosal/">Thimerosal/Thiomersal</a>
// 							</li>
// 													<li>
// 								<a href="thrombocytopenia/">Thrombocytopenia</a>
// 							</li>
// 													<li>
// 								<a href="thyroid/">Thyroid</a>
// 							</li>
// 													<li>
// 								<a href="tics/">Tics</a>
// 							</li>
// 													<li>
// 								<a href="transverse-myelitis/">Transverse Myelitis</a>
// 							</li>
// 													<li>
// 								<a href="tuberculosis/">Tuberculosis</a>
// 							</li>
// 													<li>
// 								<a href="typhoid/">Typhoid</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 																	<div class="letter-section" id="letter-V">
// 					<h2>
// 						<span>V</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="vaers/">VAERS</a>
// 							</li>
// 													<li>
// 								<a href="varicella-chickenpox/">Varicella (Chickenpox)</a>
// 							</li>
// 													<li>
// 								<a href="varicella-zoster-shingles/">Varicella Zoster (Shingles)</a>
// 							</li>
// 													<li>
// 								<a href="veterinary/">Veterinary</a>
// 							</li>
// 													<li>
// 								<a href="vitamin-k/">Vitamin K</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 												<div class="letter-section" id="letter-W">
// 					<h2>
// 						<span>W</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="whooping-cough/">Whooping Cough</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 																	<div class="letter-section" id="letter-Y">
// 					<h2>
// 						<span>Y</span>
// 					</h2>
// 					<div><ul>
// 													<li>
// 								<a href="yellow-fever/">Yellow Fever</a>
// 							</li>
// 											</ul></div>
// 				</div>
// 											</div>
// </div>





class TWW_Glossary_Scraper {
    const GLOSSARY_URL = 'https://medscienceresearch.com/';

    public function __construct() {
        add_action('rest_api_init', [$this, 'register_rest_routes']);
    }

    public function register_rest_routes() {
        register_rest_route('tww-glossary/v1', '/create-glossary-from-scrape', [
            'methods' => 'POST',
            'callback' => [$this, 'create_glossary_from_scrape'],
        ]);
    }

    public function create_glossary_from_scrape(\WP_REST_Request $request) {
        $start_letter = $request->get_param('start_letter') ? strtoupper($request->get_param('start_letter')) : null;
        
        $this->scrape_glossary($start_letter);

        $scraped_posts = get_posts([
            'post_type' => 'tww_study',
            'posts_per_page' => -1,
        ]);

        $posts = [];

        foreach ($scraped_posts as $post) {
            $posts[] = [
                'title' => $post->post_title,
                'url' => get_permalink($post->ID),
            ];
        }

        return new WP_REST_Response($posts, 200);
    }

    public function scrape_glossary($start_letter = null) {
        $html = file_get_contents(self::GLOSSARY_URL);
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $xpath = new DOMXPath($dom);
        $letters = $xpath->query('//div[@id="inner-slider"]/div[@class="letter-section"]');

        $start_importing = false;
        
        foreach ($letters as $letter) {
            $letter_title = $letter->getElementsByTagName('span')[0]->nodeValue;

            if ($letter_title === $start_letter) {
                $start_importing = true;
            }

            if (!$start_importing) {
                continue; // If we haven't reached the start letter, skip this letter
            }

            $terms = $letter->getElementsByTagName('li');
            foreach ($terms as $term) {
                $term_title = $term->getElementsByTagName('a')[0]->nodeValue;
                $term_url = $term->getElementsByTagName('a')[0]->getAttribute('href');

                $post_content_html = file_get_contents(self::GLOSSARY_URL . $term_url); 
                $post_content_dom = new DOMDocument();
                libxml_use_internal_errors(true);
                $post_content_dom->loadHTML($post_content_html);
                libxml_clear_errors();
                $post_content_xpath = new DOMXPath($post_content_dom);
                $post_content = $post_content_xpath->query('//div[@class="post-summary"]');
                $post_content = $post_content->item(0)->nodeValue;

                $this->create_glossary_post($term_title, $term_url, $post_content);
            }
        }

        die;
    }

    public function create_glossary_post($title, $url,  $content) {
        
        if (null === get_page_by_title($title, OBJECT, 'tww_study')) {
            // Post does not exist, create new post
            $post_id = wp_insert_post([
                'post_title' => $title,
                'post_type' => 'tww_study',
                'post_status' => 'publish',
                'post_content' => $content
            ]);
        } else {

        }
    }

}

$scaper = new TWW_Glossary_Scraper();






/**
 * 
 * 
 * 
 * The following is an example of the page that opens up when you click one of the category links that are organized by letter above. We want to store this as the content that gets scraped and stored in the post content. We only want the description
 * and link to the studies (class="autohyperlink") to be stored in the post content - we do not want the tags.
 */

// <div class="post-summary">
//                                 <p>   
//                                 </p><p><strong>Scientific studies and articles from PubMed on the dangers of aluminum in vaccines: </strong></p><strong>
// <p>—</p>
// <p><strong>Administration of aluminium to neonatal mice in vaccine-relevant amounts is associated with adverse long term neurological outcomes.</strong></p><strong>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/neurological/">#Neurological</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/23932735/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/23932735/</a></p>
// <p>—</p>
// <p><strong>Adverse reactions after injection of adsorbed diphtheria-pertussis-tetanus (DPT) vaccine are not due only to pertussis organisms or pertussis components in the vaccine.</strong></p><strong>
// <p><a href="../tag/dtp/">#DTP</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/1759487/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/1759487/</a></p>
// <p>—</p>
// <p><strong>Aluminium chloride promotes tumorigenesis and metastasis in normal murine mammary gland epithelial cells.</strong></p><strong>
// <p><a href="../tag/cancer/">#Cancer</a> <a href="../tag/breast/">#Breast</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/tumors/">#Tumors</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/27541736/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/27541736/</a></p>
// <p>—</p>
// <p><strong>Aluminum adjuvant linked to Gulf War illness induces motor neuron death in mice.</strong></p><strong>
// <p><a href="../tag/gulf/">#Gulf</a> <a href="../tag/war/">#War</a> <a href="../tag/syndrome/">#Syndrome</a> <a href="../tag/autoimmunity/">#Autoimmunity</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/17114826/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/17114826/</a></p>
// <p>—</p>
// <p><strong>Aluminum hydroxide injections lead to motor deficits and motor neuron degeneration.</strong></p><strong>
// <p><a href="../tag/gulf/">#Gulf</a> <a href="../tag/war/">#War</a> <a href="../tag/syndrome/">#Syndrome</a> <a href="../tag/aluminum/">#Aluminum</a>&nbsp; <a href="../tag/als/">#ALS</a> <a href="../tag/anthrax/">#Anthrax</a> <a href="../tag/neurological/">#Neurological</a> <a href="../tag/vaccine/">#Vaccine</a><br>
// <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/19740540/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/19740540/</a></p>
// <p>—</p>
// <p><strong>Aluminum in the central nervous system (CNS): toxicity in humans and animals, vaccine adjuvants, and autoimmunity.</strong></p><strong>
// <p>“We have examined the neurotoxicity of aluminum in humans and animals under various conditions, following different routes of administration, and provide an overview of the various associated disease states. The literature demonstrates clearly negative impacts of aluminum on the nervous system across the age span. In adults, aluminum exposure can lead to apparently age-related neurological deficits resembling Alzheimer’s and has been linked to this disease and to the Guamanian variant, ALS-PDC. Similar outcomes have been found in animal models. In addition, injection of aluminum adjuvants in an attempt to model Gulf War syndrome and associated neurological deficits leads to an ALS phenotype in young male mice. In young children, a highly significant correlation exists between the number of pediatric aluminum-adjuvanted vaccines administered and the rate of autism spectrum disorders. Many of the features of aluminum-induced neurotoxicity may arise, in part, from autoimmune reactions, as part of the ASIA syndrome.”</p>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/animal/">#Animal</a> <a href="../tag/asia/">#ASIA</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/neurological/">#Neurological</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/pubmed/23609067/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/pubmed/23609067/</a></p>
// <p>—</p>
// <p><strong>‘ASIA’ - autoimmune/inflammatory syndrome induced by adjuvants.</strong></p><strong>
// <p><a href="../tag/autoimmunity/">#Autoimmunity</a> <a href="../tag/asia/">#ASIA</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/autoimmunity/">#Autoimmunity</a> <a href="../tag/gulf/">#Gulf</a> <a href="../tag/war/">#War</a> <a href="../tag/syndrome/">#Syndrome</a> <a href="../tag/macrophagic/">#Macrophagic</a> <a href="../tag/myofasciitis/">#Myofasciitis</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="http://www.ncbi.nlm.nih.gov/m/pubmed/20708902/" class="autohyperlink" target="_blank">http://www.ncbi.nlm.nih.gov/m/pubmed/20708902/</a></p>
// <p>—</p>
// <p><strong>Autoimmune/autoinflammatory syndrome induced by adjuvants (ASIA syndrome) in commercial sheep.</strong></p><strong>
// <p><a href="../tag/animal/">#Animal</a> <a href="../tag/asia/">#ASIA</a> <a href="../tag/autoimmunity/">#Autoimmunity</a> <a href="../tag/veterinary/">#Veterinary</a> <a href="../tag/neurological/">#Neurological</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/23579772/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/23579772/</a></p>
// <p>—</p>
// <p><strong>Biopersistence and Brain Translocation of Aluminum Adjuvants of Vaccines</strong></p><strong>
// <p>Concerns about the use of aluminum adjuvants have emerged following (i) recognition of their role at the origin of the so-called macrophagic myofasciitis (MMF) lesion in 2001 (3, 4), which revealed fundamental misconception of their adjuvant effect and pointed out their unexpectedly long-lasting biopersistence (4); and (ii) demonstration of their apparent capacity to migrate in lymphoid organs and then disseminate throughout the body within monocyte-lineage cells and progressively accumulate in the brain (5).</p>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a> <a href="../tag/macrophagic/">#Macrophagic</a> <a href="../tag/myofascitits/">#Myofascitits</a> <a href="../tag/biopersistence/">#Biopersistence</a> <a href="../tag/brain/">#Brain</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4318414/?fbclid=IwAR38ApSkpEWP98R_9esKParoMT4O2lakUuaprGv3gIe-EN7XNB-sb4jCdHk" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4318414/?fbclid=IwAR38ApSkpEWP98R_9esKParoMT4O2lakUuaprGv3gIe-EN7XNB-sb4jCdHk</a></p>
// <p>—</p>
// <p><strong>[Biopersistence and systemic distribution of intramuscularly injected particles: what impact on long-term tolerability of alum adjuvants?]</strong></p><strong>
// <p><a href="../tag/chronic/">#Chronic</a> <a href="../tag/fatigue/">#Fatigue</a> <a href="../tag/syndrome/">#Syndrome</a><br>
// <a href="../tag/macrophagic/">#Macrophagic</a> <a href="../tag/myofasciitis/">#Myofasciitis</a>&nbsp; <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/asia/">#ASIA</a> <a href="../tag/autoimmunity/">#Autoimmunity</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/26259285" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/26259285</a></p>
// <p>—</p>
// <p><strong>Do aluminum vaccine adjuvants contribute to the rising prevalence of autism?</strong></p><strong>
// <p><a href="../tag/autism/">#Autism</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a> <a href="../tag/neurological/">#Neurological</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/22099159/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/22099159/</a></p>
// <p>—</p>
// <p><strong>Effect of concurrent chronic exposure of fluoride and aluminum on rat brain.</strong></p><strong>
// <p>Kaur T, et al. Drug Chem Toxicol. 2009.</p>
// <p>“The present in vivo study was designed to investigate the toxic potential of fluoride alone and in conjugation with aluminum on the rat brain. The region-specific response of both elements was studied in different regions of brain, namely the cerebrum, cerebellum, and medulla oblongata. Following fluoride exposure, oxidative stress increased significantly, estimated by increased lipid peroxidation and a decrease in the activity of the antioxidant enzyme, superoxide dismutase. The neurotransmitter (e.g., dopamine, norepinephrine, and serotonin) content was also altered. However, these aspects were more pronounced in animals given fluoride and aluminum together. Histological evidence showed deprivation of neuronal integrity with higher magnitude in concurrent fluoride and aluminum exposure, as compared to fluoride alone. Thus, it can be concluded that aluminum appears to enhance the neurotoxic hazards caused by fluoride.” </p>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/fluoride/">#Fluoride</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a> </p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/19538017/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/19538017/</a></p>
// <p>—</p>
// <p><strong>How aluminum adjuvants could promote and enhance non-target IgE synthesis in a genetically-vulnerable sub-population.</strong></p><strong>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/22967010/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/22967010/</a></p>
// <p>—</p>
// <p><strong>Macrophagic myofasciitis associated with vaccine-derived aluminium.</strong></p><strong>
// <p>“Macrophagic myofasciitis is characterised by sheets of macrophages in striated muscle, a few lymphocytes and inconspicuous muscle fibre damage. It is due to aluminium contained in vaccines, and is localised to the inoculation site. We report the first Australian case, detected incidentally when investigating a raised serum creatine kinase level.” </p>
// <p><a href="../tag/macrophagic/">#Macrophagic</a> <a href="../tag/myofasciitis/">#Myofasciitis</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/musculoskeletal/">#Musculoskeletal</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a> </p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/16053418/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/16053418/</a></p>
// <p>—</p>
// <p><strong>Macrophagic myofasciitis lesions assess long-term persistence of vaccine-derived aluminium hydroxide in muscle.</strong></p><strong>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/macrophagic/">#Macrophagic</a> <a href="../tag/myofasciitis/">#Myofasciitis</a> <a href="../tag/hepatitis/">#Hepatitis</a> A <a href="../tag/musculoskeletal/">#Musculoskeletal</a> <a href="../tag/hepatitis/">#Hepatitis</a> B <a href="../tag/tetanus/">#Tetanus</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a> </p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/11522584/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/11522584/</a></p>
// <p>—</p>
// <p><strong>Mechanisms of aluminum adjuvant toxicity and autoimmunity in pediatric populations.</strong></p><strong>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/autoimmunity/">#Autoimmunity</a> <a href="../tag/asia/">#ASIA</a><br>
// <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/22235057/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/22235057/</a></p>
// <p>—</p>
// <p><strong>Mechanisms of aluminum adjuvant toxicity and autoimmunity in pediatric populations.</strong></p><strong>
// <p><a href="../tag/autoimmunity/">#Autoimmunity</a> <a href="../tag/aluminum/">#Aluminum</a><br>
// <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/22235057/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/22235057/</a></p>
// <p>—</p>
// <p><strong>The neurotoxicity of environmental aluminum is still an issue</strong></p><strong>
// <p><a href="../tag/parkinsons/">#Parkinsons</a> <a href="../tag/alzheimers/">#Alzheimers</a><br>
// <a href="../tag/aluminum/">#Aluminum</a>&nbsp; <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/pmc/articles/PMC2946821/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/pmc/articles/PMC2946821/</a></p>
// <p>–</p>
// <p><strong>Non-linear dose-response of aluminium hydroxide adjuvant particles: Selective low dose neurotoxicity.</strong></p><strong>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/chronic/">#Chronic</a> <a href="../tag/fatigue/">#Fatigue</a> <a href="../tag/syndrome/">#Syndrome</a>&nbsp; <a href="../tag/dysautonomia/">#Dysautonomia</a> <a href="../tag/autoimmunity/">#Autoimmunity</a> <a href="../tag/vaccines/">#Vaccines</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/27908630/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/27908630/</a></p>
// <p>—</p>
// <p><strong>Occurrence of severe destructive lyme arthritis in hamsters vaccinated with outer surface protein A and challenged with Borrelia burgdorferi.</strong></p><strong>
// <p>“When the canine rOspA vaccine was combined with aluminum hydroxide, all vaccinated hamsters developed arthritis after challenge with B. burgdorferi sensu stricto. Histopathologic examination confirmed the development of severe destructive arthritis in rOspA-vaccinated hamsters challenged with B. burgdorferi sensu stricto. These findings suggest that rOspA vaccines should be modified to eliminate epitopes of OspA responsible for the induction of arthritis. Our results are important because an rOspA vaccine in aluminum hydroxide was approved by the Food and Drug Administration for use in humans.”</p>
// <p><a href="../tag/lyme/">#Lyme</a> <a href="../tag/arthritis/">#Arthritis</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/borrelia/">#Borrelia</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/autoimmunity/">#Autoimmunity</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/10639430" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/10639430</a></p>
// <p>—</p>
// <p>🛑 <strong>A possible central mechanism in autism spectrum disorders, part 1.</strong></p><strong>
// <p>“The autism spectrum disorders (ASD) are a group of related neurodevelopmental disorders that have been increasing in incidence since the 1980s. Despite a considerable amount of data being collected from cases, a central mechanism has not been offered. A careful review of ASD cases discloses a number of events that adhere to an immunoexcitotoxic mechanism. This mechanism explains the link between excessive vaccination, use of aluminum and ethylmercury as vaccine adjuvants, food allergies, gut dysbiosis, and abnormal formation of the developing brain. It has now been shown that chronic microglial activation is present in autistic brains from age 5 years to age 44 years. A considerable amount of evidence, both experimental and clinical, indicates that repeated microglial activation can initiate priming of the microglia and that subsequent stimulation can produce an exaggerated microglial response that can be prolonged. It is also known that one phenotypic form of microglia activation can result in an outpouring of neurotoxic levels of the excitotoxins, glutamate and quinolinic acid. Studies have shown that careful control of brain glutamate levels is essential to brain pathway development and that excesses can result in arrest of neural migration, as well as dendritic and synaptic loss. It has also been shown that certain cytokines, such as TNF-alpha, can, via its receptor, interact with glutamate receptors to enhance the neurotoxic reaction. To describe this interaction I have coined the term immunoexcitotoxicity, which is described in this article.”</p>
// <p><a href="../tag/autism/">#Autism</a> <a href="../tag/immune/">#Immune</a> <a href="../tag/aluminum/">#Aluminum</a><br>
// <a href="../tag/mercury/">#Mercury</a> <a href="../tag/food/">#Food</a> <a href="../tag/allergies/">#Allergies</a><br>
// <a href="../tag/gastrointestinal/">#Gastrointestinal</a><br>
// <a href="../tag/neurological/">#Neurological</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a> </p>
// <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/19043938" class="autohyperlink" target="_blank">http://www.ncbi.nlm.nih.gov/pubmed/19043938</a></p>
// <p>—</p>
// <p><strong>Postnatal toxic and acquired disorders.</strong></p><strong>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/neurological/">#Neurological</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/23622416" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/23622416</a></p>
// <p>—</p>
// <p><strong>Prolonged exposure to low levels of aluminum leads to changes associated with brain aging and neurodegeneration.</strong></p><strong>
// <p>“Epidemiological studies suggest that aluminum may not be as innocuous as was previously thought and that aluminum may actively promote the onset and progression of Alzheimer’s disease.”</p>
// <p><a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/alzheimers/">#Alzheimers</a><br>
// <a href="../tag/neurological/">#Neurological</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/24189189/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/24189189/</a></p>
// <p>—</p>
// <p><strong>A role for the body burden of aluminium in vaccine-associated macrophagic myofasciitis and chronic fatigue syndrome.</strong></p><strong>
// <p><a href="../tag/chronic/">#Chronic</a> <a href="../tag/fatigue/">#Fatigue</a> <a href="../tag/syndrome/">#Syndrome</a><br>
// <a href="../tag/macrophagic/">#Macrophagic</a> <a href="../tag/myofasciitis/">#Myofasciitis</a>&nbsp; <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/19004564/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/19004564/</a></p>
// <p>—</p>
// <p><strong>Serious adverse events after HPV vaccination: a critical review of randomized trials and post-marketing case series.</strong></p><strong>
// <p>Martínez-Lavín M, et al. Clin Rheumatol. 2017.</p>
// <p>“This article critically reviews HPV vaccine serious adverse events described in pre-licensure randomized trials and in post-marketing case series. HPV vaccine randomized trials were identified in PubMed. Safety data were extracted. Post-marketing case series describing HPV immunization adverse events were reviewed. Most HPV vaccine randomized trials did not use inert placebo in the control group. Two of the largest randomized trials found significantly more severe adverse events in the tested HPV vaccine arm of the study. Compared to 2871 women receiving aluminum placebo, the group of 2881 women injected with the bivalent HPV vaccine had more deaths on follow-up (14 vs. 3, p = 0.012). Compared to 7078 girls injected with the 4-valent HPV vaccine, 7071 girls receiving the 9-valent dose had more serious systemic adverse events (3.3 vs. 2.6%, p = 0.01). For the 9-valent dose, our calculated number needed to seriously harm is 140 (95% CI, 796-53). The number needed to vaccinate is 1757 (95% CI, 131 to infinity). Practically, none of the serious adverse events occurring in any arm of both studies were judged to be vaccine-related. Pre-clinical trials, post-marketing case series, and the global drug adverse reaction database (VigiBase) describe similar post-HPV immunization symptom clusters. Two of the largest randomized HPV vaccine trials unveiled more severe adverse events in the tested HPV vaccine arm of the study. Nine-valent HPV vaccine has a worrisome number needed to vaccinate/number needed to harm quotient. Pre-clinical trials and post-marketing case series describe similar post-HPV immunization symptoms.”</p>
// <p><a href="../tag/gardasil/">#Gardasil</a> <a href="../tag/death/">#Death</a> <a href="../tag/hpv/">#HPV</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/corruption/">#Corruption</a>  <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="https://www.ncbi.nlm.nih.gov/m/pubmed/28730271/" class="autohyperlink" target="_blank">https://www.ncbi.nlm.nih.gov/m/pubmed/28730271/</a></p>
// <p>—</p>
// <p><strong>Vaccine-related serious adverse events might have been under-recognized in the pivotal HPV vaccine randomized trial (2017)</strong></p><strong>
// <p>“To the Editor:<br>
// After seeing several healthy girls developing a severe chronic illness soon after HPV vaccination [1], I analyzed all HPV vaccine randomized controlled trials.</p>
// <p>The overwhelming majority of pre-licensure HPV vaccine randomized trials did not use inert placebo as comparator. The largest nine-valent HPV immunization trial [2] compared the newly developed nine-valent HPV vaccine vs. the four-valent HPV formulation. The innovative nine-valent HPV dose has more than double HPV virus-like particles and aluminum adjuvant than the previous formulation. Double-blind safety analysis contrasted 7071 subjects immunized with the nine-valent vaccine vs. 7078 who had the four-valent dose. The nine-valent cohort had significantly more systemic serious adverse events; n = 233 (3.3%) vs. n = 183 (2.6%) in the other group. Our calculated 2 × 2 contingency table pvalue was 0.0125. Oddly, only two subjects (0%) in each group were judged to have a vaccine-related serious adverse event. The authors did not comment on this incongruity.</p>
// <p>This discrepancy arising from a pivotal large randomized double-blind trial suggests that nine-valent HPV vaccine-related serious adverse events were under-recognized. This emerging information casts further doubt on HPV vaccine safety.”</p>
// <p><a href="../tag/hpv/">#HPV</a> <a href="../tag/gardasil/">#Gardasil</a> <a href="../tag/aluminum/">#Aluminum</a> <a href="../tag/corruption/">#Corruption</a> <a href="../tag/vaccine/">#Vaccine</a> <a href="../tag/medscienceresearch/">#MedScienceResearch</a></p>
// <p><a href="http://link.springer.com/article/10.1007%2Fs10067-017-3575-z" class="autohyperlink" target="_blank">http://link.springer.com/article/10.1007%2Fs10067-017-3575-z</a></p>
//                                 <p></p>
//                             </strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></strong></div>